var gulp = require('gulp');
var notify = require('gulp-notify');
var wpPot = require('gulp-wp-pot');

var textDomain = 'private-posts-per-user';
var potFile = 'private-posts-per-user.pot';
var translationDestination = './App/lang';
var packageName = 'private-posts-per-user';
var phpFiles = './App/**/*.php'; // Path to all PHP files.


function pot() {
  return gulp.src(phpFiles)
    .pipe(wpPot({
      domain: textDomain,
      package: packageName,
    }))
    .pipe(gulp.dest(translationDestination + '/' + potFile))
    .pipe(notify({ message: 'TASK: "pot" Completed! 💯', onLast: true }))
};

exports.pot = pot;