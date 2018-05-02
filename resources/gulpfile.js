// Defining base pathes
var basePaths = {
    js: './js/',
    node: './node_modules/',
    dev: './src/',
    lib: './libraries/',
    pp_modules: '../modules/'
};


// Defining requirements
var gulp = require('gulp');
var plumber = require('gulp-plumber');
var watch = require('gulp-watch');
var rename = require('gulp-rename');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var merge2 = require('merge2');
var rimraf = require('gulp-rimraf');
var clone = require('gulp-clone');
var merge = require('gulp-merge');
var sourcemaps = require('gulp-sourcemaps');
var del = require('del');

function swallowError(self, error) {
    console.log(error.toString())

    self.emit('end')
}


// Run:
// gulp scripts.
// Uglifies and concat all JS files into one
gulp.task('scripts', function() {
    var scripts = [

        // JQuery
        basePaths.dev + '/js/jquery/jquery.js',

        // JQuery Validation
        basePaths.dev + '/js/jquery-validation/jquery.validate.js',

        // Bootstrap 4
        basePaths.dev + 'js/bootstrap4/bootstrap.js',

        // PW Strength
        basePaths.dev + '/js/pwstrength/pwstrength-bootstrap.js',

        // MVC App JS
        basePaths.js + 'app.js',

        // Module - BS Modal Login
        basePaths.dev + '/js/bs_modal_login/script.js',

    ];
    gulp.src(scripts)
        .pipe(concat('pp_scripts.min.js'))
        .pipe(uglify().on('error', function(e){
            console.log(e);
        }))
        .pipe(gulp.dest('./js/'));

    gulp.src(scripts)
        .pipe(concat('pp_scripts.js'))
        .pipe(gulp.dest('./js/'));
});

// Deleting any file inside the /src folder
gulp.task('clean-source', function () {
    return del(['src/**/*',]);
});



// Run:
// gulp copy-assets.
// Copy all needed dependency assets files from bower_component assets to themes /js, /scss and /fonts folder. Run this task after bower install or bower update


// Copy all Bootstrap JS files
gulp.task('copy-assets', function() {

    // JQUERY
    gulp.src(basePaths.node + '/jquery/dist/*')
    .pipe(gulp.dest(basePaths.dev + '/js/jquery'));

    // Copy all Bootstrap JS files
    gulp.src(basePaths.node + 'bootstrap/dist/js/**/*.js')
       .pipe(gulp.dest(basePaths.dev + '/js/bootstrap4'));

    // jquery-validate
    gulp.src(basePaths.node + '/jquery-validation/dist/*')
    .pipe(gulp.dest(basePaths.dev + '/js/jquery-validation'));

    // JQuery Password Meter
    gulp.src(basePaths.node + 'pwstrength-bootstrap/dist/*.js')
        .pipe(gulp.dest(basePaths.dev + '/js/pwstrength'));    

    // MODULE - BS Modal Login
    gulp.src(basePaths.pp_modules + '/bs_modal_login/js/*')
        .pipe(gulp.dest(basePaths.dev + '/js/bs_modal_login'));

});






// Run
// gulp dist
// Copies the files to the /dist folder for distributon
gulp.task('dist', ['clean-dist'], function() {
    gulp.src(['**/*','!bower_components','!bower_components/**','!node_modules','!node_modules/**','!src','!src/**','!dist','!dist/**','!sass','!sass/**','!readme.txt','!readme.md','!package.json','!gulpfile.js','!CHANGELOG.md','!.travis.yml','!jshintignore', '!codesniffer.ruleset.xml', '*'])
        .pipe(gulp.dest('dist/'))
});

// Deleting any file inside the /dist folder
gulp.task('clean-dist', function () {
    return del(['dist/**/*',]);
});

// Run
// gulp dist-product
// Copies the files to the /dist folder for distributon
gulp.task('dist-product', ['clean-dist-product'], function() {
    gulp.src(['**/*','!bower_components','!bower_components/**','!node_modules','!node_modules/**','!dist','!dist/**', '*'])
        .pipe(gulp.dest('dist-product/'))
});

// Deleting any file inside the /dist-product folder
gulp.task('clean-dist-product', function () {
    return del(['dist-product/**/*',]);
});
