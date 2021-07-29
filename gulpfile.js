const gulp = require('gulp');
const sass = require('gulp-sass');
const sassGlob = require('gulp-sass-glob');
const autoprefixer = require('gulp-autoprefixer');
const sourcemaps = require('gulp-sourcemaps');
const plumber = require('gulp-plumber');
const notify = require('gulp-notify');
const browserSync = require('browser-sync');

gulp.task('sass', function() {
	return gulp.src('./sass/**/*.scss')
		.pipe(plumber({errorHandler: notify.onError(
			"Error: <%= error.message %>"
		)}))
		.pipe(sourcemaps.init())
		.pipe(sassGlob())
		.pipe(sass({outputStyle: 'expanded'}))
		.pipe(autoprefixer({
			cascade: false
		}))
		.pipe(sourcemaps.write('./'))
		.pipe(gulp.dest('./css'));
});
gulp.task('watch', function() {
	gulp.watch('./sass/**/*.scss', gulp.task('sass'));
});