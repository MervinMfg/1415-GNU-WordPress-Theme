module.exports = function (grunt) {
	// VARIABLES
	var headerScripts = [
		'_/js/lib/modernizr-2.7.2.js'
	];
	var footerScripts = [
		'_/js/lib/jquery-1.11.1.js',
		'_/js/lib/GSAP/TweenMax.js',
		'_/js/lib/jquery.scrollmagic-1.0.8.js',
		'_/js/lib/jquery.fitvids-1.1.0.js',
		'_/js/lib/jquery.unveil.js',
		'_/js/lib/owl.carousel-2.0.0.js',
		'_/js/gnu.main.js',
		'_/js/components/*.js'
	];
	// PROJECT CONFIG
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),
		sass: {
			dev: {
				files: {
					'_/css/gnu.main.css': '_/css/gnu.main.scss'
				},
				options: {
					style: 'expanded',
					sourcemap: true,
					trace: true,
					debugInfo: true,
					lineNumbers: true
				}
			},
			prod: {
				files: {
					'_/css/gnu.main.min.css': '_/css/gnu.main.scss'
				},
				options: {
					style: 'compact',
					sourcemap: false,
					trace: false,
					debugInfo: false,
					lineNumbers: false
				}
			}
		},
		concat: {
			prod: {
				files: {
					'_/js/gnu.header.min.js': headerScripts,
					'_/js/gnu.footer.min.js': footerScripts
				}
			},
		},
		cssmin: {
			prod: {
				options: {
					banner: '/*! <%= pkg.name %> v<%= pkg.version %> | (c) <%= grunt.template.today("yyyy") %> Mervin Mfg. | mervin.com */\n'
				},
				files: {
					'_/css/gnu.main.min.css': ['_/css/gnu.main.min.css']
				}
			}
		},
		uglify: {
			options: {
				banner: '/*! <%= pkg.name %> v<%= pkg.version %> | (c) <%= grunt.template.today("yyyy") %> Mervin Mfg. | mervin.com */\n'
			},
			prod: {
				files: {
					'_/js/gnu.header.min.js': ['_/js/gnu.header.min.js'],
					'_/js/gnu.footer.min.js': ['_/js/gnu.footer.min.js']
				}
			}
		},
		watch: {
			markup: {
				files: ['*.php', 'page-templates/*.php'],
				options: {
					livereload: true,
				}
			},
			js: {
				files: ['_/js/*.js', '_/js/**/*.js'],
				options: {
					livereload: true
				}
			},
			sass: {
				files: ['_/css/*.scss', '_/css/**/*.scss'],
				tasks: ['sass'],
				options: {
					livereload: true
				}
			}
		}
	});
	// NPM TASKS
	grunt.loadNpmTasks('grunt-shell');
	grunt.loadNpmTasks('grunt-contrib-sass');
	grunt.loadNpmTasks('grunt-contrib-concat');
	grunt.loadNpmTasks('grunt-contrib-cssmin');
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-watch');
	// GRUNT TASKS
	grunt.registerTask('run', ['sass:dev', 'scriptblock']); // default
	grunt.registerTask('build', ['sass:prod', 'concat', 'cssmin', 'uglify', 'scriptblock']);
	// Automate creation of scriptblock to be loaded in footer
	grunt.registerTask('scriptblock', function () {
		var scriptHeader, scriptFooter, headerfiles, footerfiles;
		scriptHeader = scriptFooter = '<?php // AUTO-GENERATED BY GRUNT. To change this block edit Gruntfile.js, not this file! ?>\n';
		// generate header script includes
		headerScripts.forEach(function (path) {
			headerfiles = grunt.file.expand(path);
			headerfiles.forEach(function (file) {
				scriptHeader += '\t<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/' + file + '"></script>\n';
			});
			grunt.file.write('_/inc/header-scripts.php', scriptHeader);
		});
		// generate footer script includes
		footerScripts.forEach(function (path) {
			footerfiles = grunt.file.expand(path);
			footerfiles.forEach(function (file) {
				scriptFooter += '\t<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/' + file + '"></script>\n';
			});
			grunt.file.write('_/inc/footer-scripts.php', scriptFooter);
		});
	});
};