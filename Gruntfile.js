module.exports = function(grunt) {  
// Project configuration.
grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    clean: {
        assets: ['assets/*']
        //,garbage_js: ['public/assets/custom.js']
    },
    copy: {
      main: {
        expand: true,
        src: 'assets/**',
        dest: 'public/',
      },
    },
    uglify: {
        options: {
          mangle: {
            reserved: ['jQuery']
          }
        },
        new_target: {
          files: {
            'public/assets/custom.min.js': ['assets/custom.js']
          }
        }
    },
    cssmin: {
        target: {
            files: [{
                expand: true,
                cwd: 'assets/',
                src: ['*.css', '!*.min.css'],
                dest: 'public/assets/',
                ext: '.min.css'
            }]
        }
    },
    browserify: {
        build: {
            src: 'public/assets/custom.min.js',
            dest: 'bundle.js'
        }
    }
});

// Load the plugin that provides the "clean" task.
grunt.loadNpmTasks('grunt-contrib-clean');
grunt.loadNpmTasks('grunt-contrib-copy');

grunt.loadNpmTasks('grunt-contrib-uglify');
grunt.loadNpmTasks('grunt-browserify');
grunt.loadNpmTasks('grunt-contrib-cssmin');



// Default task(s).
grunt.registerTask('default', ['cssmin', 'uglify','copy','browserify','clean']);

};
