const gulp = require('gulp');
const pug = require('gulp-pug');
const plumber = require('gulp-plumber');
const sass = require('gulp-sass');

gulp.task('sass', function () {
  return gulp.src(['styles/*.scss'])
    .pipe(plumber())
    .pipe(sass().on('error', sass.logError))
    .pipe(gulp.dest('./build/css'));
});

gulp.task('watch', () => {
  gulp.watch(['styles/*.scss', 'src/styles/bootstrap/*.scss'], ['sass']);
});

gulp.task('default', ['sass']);
