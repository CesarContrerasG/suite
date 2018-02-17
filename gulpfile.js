var gulp = require('gulp'),
    uglify = require('gulp-uglify'),
    minifyCSS = require('gulp-minify-css'),
    imagemin = require('gulp-imagemin');

gulp.task ('performancejs', function(){
    gulp.src('js/*.js')
    .pipe(uglify())
    .pipe(gulp.dest('dist/js/'));
});

gulp.task ('performancecss', function(){
    gulp.src('css/*.css')
        .pipe(minifyCSS())
        .pipe(gulp.dest('dist/css/'));
});


gulp.task ('performanceimg', function(){
    gulp.src('img/**/*')
        .pipe(imagemin())
        .pipe(gulp.dest('dist/img/'));
});

gulp.task ('default', function(){
    gulp.watch('./js/*.*', ['performancejs']);
    gulp.watch('./css/*.*', ['performancecss']);
    gulp.watch('./img/**/*', ['performanceimg']);
});