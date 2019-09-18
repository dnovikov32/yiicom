var $ = require('gulp-load-plugins')();
var gulp = require('gulp');
var webpack = require('webpack-stream');

var isProd = process.env.NODE_ENV === 'prod';

gulp.task('sass', function() {
    return gulp.src(['backend/assets/src/sass/*.scss'])
        .pipe($.sass().on('error', $.sass.logError))
        .pipe($.autoprefixer({browsers: ['last 2 versions']}))
        .pipe($.if(isProd, $.cleanCss()))
        .pipe(gulp.dest('backend/assets/dist/css'));
});

gulp.task('webpack', function(){
    return gulp.src('./backend/assets/src/commerce.js')
        .pipe(webpack(require('./webpack.config.js')))
        .pipe(gulp.dest('./backend/assets/dist/js'));
});

gulp.task('watch', function () {
    gulp.watch('backend/assets/src/sass/**/*.*', ['sass']);
});

gulp.task('set-node-env-prod', function() {
    return process.env.NODE_ENV = 'prod';
});

gulp.task('default', ['sass', 'webpack', 'watch']);
gulp.task('build', ['set-node-env-prod', 'default']);