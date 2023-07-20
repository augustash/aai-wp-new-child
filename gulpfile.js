const gulp = require('gulp');
const { parallel, series } = require('gulp');
const noop = require('gulp-noop');
const gutil = require('gulp-util');
const cache = require('gulp-cached');
const fs = require('fs');
const extend = require('extend');
const rename = require('gulp-rename');
const sass = require('gulp-sass')(require('sass'));
const glob = require('gulp-sass-glob');
const autoprefixer = require('gulp-autoprefixer');
const browserSync = require('browser-sync').create();
const sourcemaps = require('gulp-sourcemaps');
const uglify = require('gulp-uglify');
const eslint = require('gulp-eslint');
const babel = require('gulp-babel');
let watchStatus = false;
let url = process.env.DDEV_HOSTNAME || null;
let gulpStylelint = require('gulp-stylelint');
let config = {
  browserSync: {
    proxy: 'http://localhost',
    port: 3000,
    openAutomatically: false,
    notify: false
  },
  css: {
    dest: 'assets/css',
    src: [
      'scss/**/*.scss'
    ],
    includePaths: [
      '../ash/scss'
    ]
  },
  js: {
    dest: 'assets/js',
    src: [
      'js/**/*.js'
    ]
  },
  components: {
    css: {
      dest: './components',
      src: [
        'components/*/*.scss',
      ],
      includePaths: [
        '../ash/scss',
        './scss/base'
      ]
    },
    js: {
      dest: './components',
      src: [
        'components/*/*.js'
      ]
    }
  }
};

// If config.js exists, load that config for overriding certain values below.
function loadConfig() {
  if (fs.existsSync('./config/dev/config.local.json')) {
    config = extend(true, config, require('./config/dev/config.local'));
  }
  return config;
}
loadConfig();

function js(cb) {
  return gulp.src(config.js.src)
    .pipe(eslint({
      configFile: 'config/dev/.eslintrc',
      useEslintrc: false
    }))
    .pipe(eslint.format())
    .pipe(babel({
        presets: ['@babel/preset-env']
    }))
    .pipe(uglify())
    .pipe(gulp.dest(config.js.dest))
    .pipe(watchStatus ? browserSync.stream() : noop());
}

function css(cb) {
  delete cache.caches['componentCss'];
  return gulp.src(config.css.src)
    .pipe(glob())
    .pipe(sourcemaps.init())
    .pipe(sass({
      outputStyle: 'compressed',
      includePaths: config.css.includePaths
    }).on('error', sass.logError))
    .pipe(autoprefixer({
      browserlist: ['last 2 versions'],
      cascade: false
    }))
    .pipe(sourcemaps.write('./'))
    .pipe(gulp.dest(config.css.dest))
    .pipe(watchStatus ? browserSync.stream() : noop())
    .on('finish', function () {
      return gulp
        .src(config.css.src)
        .pipe(gulpStylelint({
          failAfterError: false,
          reporters: [
            { formatter: 'string', console: true },
          ],
          debug: true
        }))
        ;
    });
}

function componentJs(cb) {
  return gulp.src(config.components.js.src)
    .pipe(eslint({
      configFile: 'config/dev/.eslintrc',
      useEslintrc: false
    }))
    .pipe(eslint.format())
    .pipe(babel({
        presets: ['@babel/preset-env']
    }))
    .pipe(uglify())
    .pipe(rename(function (path) {
      path.dirname = path.dirname.replace('src/scripts', '');
    }))
    .pipe(gulp.dest(config.components.js.dest))
    .pipe(watchStatus ? browserSync.stream() : noop());
}

function componentCss(cb) {
  return gulp.src(config.components.css.src)
    .pipe(glob())
    .pipe(cache('componentCss'))
    .pipe(sourcemaps.init())
    .pipe(sass({
      outputStyle: 'compressed',
      includePaths: config.components.css.includePaths
    }).on('error', sass.logError))
    .pipe(autoprefixer({
      browserlist: ['last 2 versions'],
      cascade: false
    }))
    .pipe(rename(function (path) {
      path.dirname = path.dirname.replace('src/styles', '');
    }))
    .pipe(sourcemaps.write('./'))
    .pipe(gulp.dest(config.components.css.dest))
    .pipe(watchStatus ? browserSync.stream() : noop())
    .on('finish', function () {
      return gulp
        .src(config.components.css.src)
        .pipe(gulpStylelint({
          failAfterError: false,
          reporters: [
            { formatter: 'string', console: true },
          ],
          debug: true
        }))
        ;
    });
}

function enableWatch(cb) {
  watchStatus = true;
  cb();
}

function watch(cb) {
  if (watchStatus) {
    browserSync.init({
      ui: false,
      proxy: config.browserSync.proxy,
      port: config.browserSync.port,
      open: config.browserSync.openAutomatically,
      notify: config.browserSync.notify,
      listen: url,
    });
    gulp.watch(config.css.src, css);
    gulp.watch(config.js.src, js);
    gulp.watch(config.components.css.src, componentCss);
    gulp.watch(config.components.js.src, componentJs);
  }
  else {
    cb();
  }
}

exports.default = series(parallel(js, css, componentCss, componentJs));
exports.watch = series(enableWatch, parallel(js, css, componentJs), watch);
