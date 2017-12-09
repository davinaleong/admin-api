/**********************************************************************************
	- File Info -
		File name		: gulpfile.jpg
		Author(s)		: DAVINA Leong Shi Yun
		Date Created	: 07 Dec 2017

	- Contact Info -
		Email	: leong.shi.yun@gmail.com
		Mobile	: (+65) 9369 3752 [Singapore]

***********************************************************************************/

let gulp = require("gulp");
let del = require("del");

const NODE_PATH = "./node_modules/";
const VENDOR_PATH = "./vendor/";

gulp.task("default", ["update-vendor"]);

// === manage vendor resources started ===
gulp.task("update-vendor", ["clean-vendor", "copy-vendor"]);

gulp.task("copy-vendor", () => {
    console.log("--- task: copy-vendor STARTED");

    // --- jQuery ---
    gulp.src([
        NODE_PATH + "jquery/dist/**/*.js"
    ]).pipe(gulp.dest(VENDOR_PATH + "jquery"));
    console.log("~ copied jQuery files.");

    // --- Twitter Bootstrap ---
    gulp.src([
        NODE_PATH + "bootstrap/dist/**/*.{css,js}"
    ]).pipe(gulp.dest(VENDOR_PATH + "bootstrap"));
    console.log("~ copied Bootstrap files.");

    // --- Font-Awesome ---
    gulp.src([
        NODE_PATH + "font-awesome/?(css|fonts)/*.*"
    ]).pipe(gulp.dest(VENDOR_PATH + "font-awesome"));
    console.log("~ copied Font Awesome files.");

    // --- PopperJS end ---
    gulp.src([
        NODE_PATH + "popper.js/dist/**/*.js"
    ]).pipe(gulp.dest(VENDOR_PATH + "popperjs"));
    console.log("~ copied PopperJs files.");

    // --- ParsleyJS end ---
    gulp.src([
        NODE_PATH + "parsleyjs/dist/**/*.js"
    ]).pipe(gulp.dest(VENDOR_PATH + "parsleyjs"));
    console.log("~ copied ParsleyJs files.");

    console.log("--- task: copy-vendor ENDED");
});

gulp.task("clean-vendor", () => {
    console.log("--- task: clean-vendor STARTED ---");

    del.sync([
        VENDOR_PATH + "bootstrap/**",
        VENDOR_PATH + "font-awesome/**",
        VENDOR_PATH + "jquery/**",
        VENDOR_PATH + "parsleyjs/**",
        VENDOR_PATH + "popperjs/**",
        VENDOR_PATH + "!datatables",
        "!" + VENDOR_PATH
    ]);

    console.log("--- task: clean-vendor ENDED ---");
});
// === manage vendor resources end ===