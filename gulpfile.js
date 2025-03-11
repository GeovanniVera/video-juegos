import { src, dest, watch, series } from 'gulp';
import * as dartSass from 'sass';
import gulpSass from 'gulp-sass';

const sass = gulpSass(dartSass);

export function js() {
    return src('./resources/js/**/*.js')
        .pipe(dest('./public/js'));
}

export function css() {
    return src('./resources/scss/app.scss', { sourcemaps: true })
        .pipe(sass().on('error', sass.logError))
        .pipe(dest('./public/css', { sourcemaps: '.' }));
}

export function dev() {
    watch('./resources/scss/**/*.scss', css);
    watch('./resources/js/**/*.js', js);
}

export default series(js, css, dev);