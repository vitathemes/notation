'use strict';

const {series, parallel} = require('gulp');
const browserSync = require('browser-sync').create();
const gulp = require('gulp');
const sass = require('gulp-sass');
const rtlcss = require('gulp-rtlcss');
const concat = require('gulp-concat');
const autoprefixer = require('gulp-autoprefixer');

sass.compiler = require('node-sass');

const sassSrc = "./assets/src/sass/";
const jsSrc = "./assets/src/js/";
const cssDest = "./assets/css/";
const jsDest = "./assets/js/";

function clean(cb) {
    // body omitted
    cb();
}

function css(cb) {
    return gulp.src(sassSrc + 'main.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(autoprefixer({cascade: false}))
        .pipe(gulp.dest(cssDest))
        .pipe(browserSync.stream());
    cb();
}

function rtlCss(cb) {
    return gulp.src(cssDest + 'main.css')
        .pipe(rtlcss())
        .pipe(gulp.dest('dist'));
    cb();
}

function rtlCssConcat(cb) {
    return gulp.src(['./style.css', cssDest + "main.css"])
        .pipe(concat('style-rtl.css'))
        .pipe(gulp.dest('./'));
    cb();
}

function liveServer(cb) {
    browserSync.init({
        proxy: 'holo.local'
    });
    gulp.watch([sassSrc + '**/*.scss']).on('change', gulp.series(css));
    gulp.watch("./**/*.php").on('change', browserSync.reload);
    cb();
}

exports.default = series(css, liveServer);
exports.rtlcss = series(rtlCss, rtlCssConcat);
