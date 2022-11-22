import esbuild from "esbuild";
import { sassPlugin } from "esbuild-sass-plugin";
// import postcss from 'postcss';
// import autoprefixer from 'autoprefixer';


const args = process.argv.slice(2)
const watch = args.includes('--watch')
let watchParam
if (watch) {
	watchParam =
	{
		onRebuild: (error, result) => {
			if (error) console.error('watch build failed: ', error)
			else console.log('watch build succeeded: ', result)
		}
	}
} else {
	watchParam = false
}

esbuild.build( {
	bundle: true,
	entryPoints: {
		mains: 'assets/src/js/mains.js',
		main: 'assets/src/scss/main.scss'
	},
	outdir: 'assets/dist',
	plugins: [sassPlugin()],
	sourcemap: 'external',
	watch: watchParam,
	minify: false
}).then(result => { watch ? console.log('watching...') : true})
.catch(() => process.exit())
