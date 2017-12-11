// Include gulp
var gulp = require('gulp');
var browserSync = require('browser-sync').create();

// Include Plugins
var jshint = require('gulp-jshint');
var sass = require('gulp-sass');
var sassGlob = require('gulp-sass-glob');
var sourcemaps = require('gulp-sourcemaps');
var concat = require('gulp-concat');
var concatCss = require('gulp-concat-css');
var uglify = require('gulp-uglify');
var rename = require('gulp-rename');
var cssmin = require('gulp-cssmin');
var debug  = require('gulp-debug');

/****************** GENERAL THEME SETTINGS - START ******************/

// Concatenate theme js files
gulp.task('concat-js', function () {
    return gulp.src([
        '../js/default-temp.js',
        '../framework/modules/popup/assets/js/popup.js'

    ]).pipe(concat('../js/default.js'))
        .pipe(gulp.dest('../js'));
});

// Minify JS
gulp.task('minifyjs', ['concat-js'], function () {
    return gulp.src([
        '../js/default.js',
        '../js/ajax.js',
        '../framework/modules/woocommerce/assets/js/woocommerce.js'
    ]).pipe(uglify())
        .pipe(rename({suffix: '.min'}))
        .pipe(gulp.dest('../js'))
});

// Compile Theme Sassa
gulp.task('sass', function () {
    return gulp.src('../css/scss/*.scss')
        .pipe(sourcemaps.init({loadMaps: true}))
        .pipe(sassGlob())
        .pipe(sass({outputStyle: 'expanded'}).on('error', sass.logError))
        .pipe(sourcemaps.write('../css'))
        .pipe(gulp.dest('../css'))
        .pipe(browserSync.stream({match: '**/*.css'}))
});

// Compile Woo Sass
gulp.task('woo-sass', function () {
    return gulp.src('../framework/modules/woocommerce/assets/css/scss/*.scss')
        .pipe(sourcemaps.init({loadMaps: true}))
        .pipe(sassGlob())
        .pipe(sass({outputStyle: 'expanded'}).on('error', sass.logError))
        .pipe(sourcemaps.write('../css'))
        .pipe(gulp.dest('../css'))
});

// Compile Popup Global Sass
gulp.task('popup-sass', function () {
    return gulp.src('../framework/modules/popup/assets/css/scss/*.scss')
        .pipe(sourcemaps.init({loadMaps: true}))
        .pipe(sassGlob())
        .pipe(sass({outputStyle: 'expanded'}).on('error', sass.logError))
        .pipe(sourcemaps.write('../css'))
        .pipe(gulp.dest('../framework/modules/popup/assets/css'))
});

//Concat css
gulp.task('concat-css', ['sass','popup-sass'], function () {
    return gulp.src([
        '../css/stylesheet.css',
        '../framework/modules/popup/assets/css/*-map.css'
    ])
        .pipe(concatCss('../css/stylesheet.css',{rebaseUrls:false}))
        .pipe(gulp.dest('../css'))
});

//Concat responsive css
gulp.task('concat-css-responsive', ['sass','popup-sass'], function () {
    return gulp.src([
        '../css/responsive.css',
        '../framework/modules/popup/assets/css/*-map-responsive.css'
    ])
        .pipe(concatCss('../css/responsive.css',{rebaseUrls:false}))
        .pipe(gulp.dest('../css'))
});

//Minify css files
gulp.task('minifycss', ['sass', 'concat-css', 'concat-css-responsive', 'woo-sass'], function () {
    return gulp.src([
        '../css/stylesheet.css',
        '../css/responsive.css',
        '../css/vertical_responsive.css',
        '../css/woocommerce.css',
        '../css/woocommerce_responsive.css'
    ])
        .pipe(cssmin())
        .pipe(rename({suffix: '.min'}))
        .pipe(gulp.dest('../css'))
        .pipe(browserSync.stream())
});

/****************** GENERAL THEME SETTINGS - END ******************/

/****************** MEMBERSHIP PLUGIN SETTINGS - START ******************/

// Concatenate membership js files and minify them
gulp.task('membership-js', function () {
    return gulp.src([
        '../../../plugins/select-membership/assets/js/modules/*.js',
    ]).pipe(concat('qode-membership.js'))
        .pipe(gulp.dest('../../../plugins/select-membership/assets/js'))
        .pipe(uglify())
        .pipe(rename({suffix: '.min'}))
        .pipe(gulp.dest('../../../plugins/select-membership/assets/js'));
});

// Compile membership Sass
gulp.task('membership-sass', function () {
    return gulp.src('../../../plugins/select-membership/assets/css/scss/*.scss')
        .pipe(sourcemaps.init({loadMaps: true}))
        .pipe(sassGlob())
        .pipe(sass({outputStyle: 'expanded'}).on('error', sass.logError))
        .pipe(sourcemaps.write('../../../select-membership/assets/css'))
        .pipe(gulp.dest('../../../plugins/select-membership/assets/css'))
        .pipe(cssmin())
        .pipe(rename({suffix: '.min'}))
        .pipe(gulp.dest('../../../plugins/select-membership/assets/css'))
        .pipe(browserSync.stream())
});

/****************** MEMBERSHIP PLUGIN SETTINGS - END ******************/

/****************** RESTAURANT PLUGIN SETTINGS - START ******************/

// Concatenate restaurant js files and minify them
gulp.task('restaurant-js', function () {
	return gulp.src([
		'../../../plugins/select-restaurant/assets/js/modules/*.js',
		'../../../plugins/select-restaurant/modules/**/assets/js/*.js',
	]).pipe(concat('qode-restaurant.js'))
		.pipe(gulp.dest('../../../plugins/select-restaurant/assets/js'))
		.pipe(uglify())
		.pipe(rename({suffix: '.min'}))
		.pipe(gulp.dest('../../../plugins/select-restaurant/assets/js'));
});

// Compile Restaurant Sass
gulp.task('restaurant-sass', function () {
	return gulp.src('../../../plugins/select-restaurant/assets/css/scss/*.scss')
		.pipe(sourcemaps.init({loadMaps: true}))
		.pipe(sassGlob())
		.pipe(sass({outputStyle: 'expanded'}).on('error', sass.logError))
		.pipe(sourcemaps.write('../../../select-restaurant/assets/css'))
		.pipe(gulp.dest('../../../plugins/select-restaurant/assets/css'))
		.pipe(cssmin())
		.pipe(rename({suffix: '.min'}))
		.pipe(gulp.dest('../../../plugins/select-restaurant/assets/css'))
		.pipe(browserSync.stream())
});

/****************** RESTAURANT PLUGIN SETTINGS - END ******************/

// Default Task
gulp.task('default', ['sass','woo-sass', 'membership-sass', 'restaurant-sass']);

// Minify Files
gulp.task('minify', ['minifyjs','membership-js', 'restaurant-js', 'minifycss', 'membership-sass', 'restaurant-sass']);

// Watch Files For Changes
gulp.task('watch', function () {
    gulp.watch([
        '../../../plugins/select-*/**/assets/css/scss/**/*.scss',
        '../css/scss/**/*.scss',
        '../framework/modules/woocommerce/assets/css/scss/**/*.scss',
        '../framework/modules/woocommerce/shortcodes/**/assets/css/scss/**/*.scss',
        '../framework/modules/woocommerce/plugins/**/assets/css/scss/**/*.scss',
    ],['minifycss','membership-sass', 'restaurant-sass']);
    gulp.watch([
        '../../../plugins/select-*/assets/js/modules/*.js',
        '../../../plugins/select-*/modules/**/assets/js/*.js',
        '../js/default.js',
        '../js/ajax.js',
        '../framework/modules/woocommerce/assets/js/woocommerce.js'
    ],['minifyjs','membership-js', 'restaurant-js']);
});

// Watch with browser sync
gulp.task('dev', function () {
    browserSync.init({
        proxy: 'theme22.dev'
    });

    gulp.watch([
        '../../../plugins/select-*/**/assets/css/scss/**/*.scss',
        '../css/scss/**/*.scss',
        '../framework/modules/woocommerce/assets/css/scss/**/*.scss',
        '../framework/modules/woocommerce/shortcodes/**/assets/css/scss/**/*.scss',
        '../framework/modules/woocommerce/plugins/**/assets/css/scss/**/*.scss',
    ],['minifycss','membership-sass','restaurant-sass']);
    gulp.watch([
        '../../../plugins/select-*/assets/js/modules/*.js',
        '../../../plugins/select-*/modules/**/assets/js/*.js',
        '../js/default.js',
        '../js/ajax.js',
        '../framework/modules/woocommerce/assets/js/woocommerce.js'
    ],['minifyjs','membership-js', 'restaurant-js']);
});