'use strict';

/**
 * LOAD PLUGIN
 * external plugin into node-modules
 */
var autoprefixer        = require('gulp-autoprefixer'),
    changed             = require('gulp-changed'),
    cleanCSS            = require('gulp-clean-css'),
    gulp                = require('gulp'),
    imagemin            = require('gulp-imagemin'),
    sass                = require('gulp-sass');

/**
 * GULP SASS
 */
function gulpSass() {
    return gulp.src('./assets/sass/**/*.{scss,css}')
        .pipe(sass().on('error', sass.logError))
        .pipe(cleanCSS({rebase: false}))
        .pipe(autoprefixer({
            remove: false
        }))
        .pipe(gulp.dest('./public/assets/css/'));
}

/**
 * IMAGES
 */
function images() {
    return gulp.src('./assets/img/**/*.{png,gif,jpg,jpeg}')
        .pipe(changed('./public/assets/img/'))
        .pipe(imagemin([
            imagemin.gifsicle({interlaced: true}),
            imagemin.jpegtran({progressive: true}),
            imagemin.optipng({
                interlaced: true,
                optimizationLevel: 7
            })
        ], {
            verbose: true
        }))
        .pipe(gulp.dest('./public/assets/img/'));
}

/**
 * WATCH
 */
function watchFiles() {
    gulp.watch('./assets/img/**/*.{png,gif,jpg,jpeg}', images);
    gulp.watch('./assets/sass/**/*', gulpSass);
}

/**
 * EXPORT
 */
exports.images = images;
exports.gulpSass = gulpSass;
exports.watchFiles = watchFiles;

var build = gulp.series(gulpSass, gulp.parallel(images));
var watch = gulp.parallel(watchFiles);

gulp.task('build', build);
gulp.task('watch', watch);
gulp.task('default', build);