var gulp = require('gulp');
var sass = require('gulp-sass');
var watch = require('gulp-watch');
var imagemin = require ('gulp-imagemin');

// TASK LIST
function gulpSass() {
    return gulp.src('./assets/sass/**/*.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(gulp.dest('./public/assets/css/'))
}

function gulpImage() {
    return gulp.src('./assets/img/**/*.{png,gif,jpg,jpeg}')
        .pipe(imagemin())
        .pipe(gulp.dest('./public/assets/img/'))
}

function watchFiles() {
    gulp.watch('./assets/sass/**/*.scss', gulpSass);
    gulp.watch('./assets/img/**/*.{png,gif,jpg,jpeg}', gulpImage);
}



// EXPORT TASK
exports.gulpSass = gulpSass;

exports.gulpImage = gulpImage;

var build = gulp.series(gulpSass);

gulp.task('images', gulpImage);

gulp.task('watch', watchFiles);

gulp.task('default', build);