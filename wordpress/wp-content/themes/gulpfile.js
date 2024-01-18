
import gulp from 'gulp';

// Base

import { deleteSync } from 'del';
import gulpSourcemaps from 'gulp-sourcemaps';
import gulpAutoprefixer from 'gulp-autoprefixer';
import browserSync from 'browser-sync';
let sync = browserSync.create();

// For scripts
import gulpBabel from 'gulp-babel';
import gulpConcat from 'gulp-concat';
import gulpUglify from 'gulp-uglify';

// For images

import gulpWebp from 'gulp-webp';
import gulpAvif from 'gulp-avif';
import gulpImagemin, { mozjpeg } from 'gulp-imagemin';
import gulpNewer from 'gulp-newer';

// For styles

import dartSass from 'sass';
import gulpSass from 'gulp-sass';
import GulpCleanCss from 'gulp-clean-css';

const sass = gulpSass(dartSass);

// For HTML

import gulpHtmlmin from 'gulp-htmlmin';
import gulpFileIncluder from 'gulp-file-include';



let paths = {
    html: {
        src: 'src/html/**/*.html',
        main: 'src/html/pages/*.html',
        dest: 'dist/'
    },
    js: {
        src: 'src/**/*.js',
        dest: 'dist/assets/'
    },
    styles: {
        src: 'src/scss/**/*.scss',
        main: 'src/scss/style.scss',
        dest: 'dist/'
    },
    images: {
        src: 'src/img/**/*',
        dest: 'dist/assets/img/'
    }
}

// Base functions (if you wan't to elimenate files that you don't need. In example: old files js and css)

async function clean() {
    deleteSync(['dist/**/*', '!dist/img']);
}


async function html() {
    gulp.src(paths.html.main)
        .pipe(gulpFileIncluder().on('error', function (err) {
            console.log("Path isn't correct");
        }))
        // .pipe(gulpHtmlmin({
        //     collapseWhitespace: true
        // }))
        .pipe(gulp.dest(paths.html.dest))
        .pipe(sync.stream());
}


/* .pipe(gulpUglify()).on('error', function (err) {
    console.log('Code have syntaxis errors');
}) */
async function js() {
    return gulp.src(paths.js.src)
        .pipe(gulpSourcemaps.init())
        .pipe(gulpSourcemaps.write())
        .pipe(gulp.dest(paths.js.dest))
}

async function styles() {
    return gulp.src(paths.styles.main)
        .pipe(gulpSourcemaps.init())
        .pipe(sass().on('error', sass.logError))
        .pipe(gulpAutoprefixer({
            cascade: false
        }))
        .pipe(gulpConcat('style.css'))
        // .pipe(GulpCleanCss({
        //     level: 2
        // }))
        .pipe(gulpSourcemaps.write())
        .pipe(gulp.dest(paths.styles.dest))
}

async function imagesToWebp() {
    return gulp.src(paths.images.src)
        .pipe(gulpNewer(paths.images.dest))
        .pipe(gulpWebp({
            quality: 80
        }))
        .pipe(gulp.dest(paths.images.dest))
}

// async function imagesToAvif() {
//     return gulp.src(paths.images.src)
//         .pipe(gulpNewer(paths.images.dest))
//         .pipe(gulpAvif({
//             quality: 75
//         }))
//         .pipe(gulp.dest(paths.images.dest))
// }

// async function images() {
//     return gulp.src(paths.images.src)
//         .pipe(gulpNewer(paths.images.dest))
//         .pipe(gulpImagemin())
//         .pipe(gulp.dest(paths.images.dest))
// }


async function watch() {
    sync.init({
        server: {
            baseDir: "./dist"
        }
    });
    gulp.watch((paths.html.src), html)
    gulp.watch((paths.html.src)).on('change', sync.reload);
    gulp.watch(paths.js.src, js);
    gulp.watch(paths.styles.src, styles).on('change', sync.reload);
    // gulp.watch(paths.images.src, images);
    // gulp.watch(paths.images.src, imagesToAvif);
    gulp.watch(paths.images.src, imagesToWebp);
}

let build = gulp.series(gulp.parallel(html, js, styles, imagesToWebp), watch);

export default build

export { clean }