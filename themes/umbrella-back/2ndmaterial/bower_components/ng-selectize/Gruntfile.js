module.exports = function (grunt) {

  grunt.initConfig({

    jshint: {
      options: {
        jshintrc: true,
          ignores: [
            'describe',
            'it'
          ]
       },
       files: [
        'ng-selectize.js',
        'Gruntfile.js'
       ]
    },

    uglify: {
      dist: {
        files: [
            {'ng-selectize.min.js': 'ng-selectize.js'}
        ]
      }
    },

    copy: {
      example: {
        files: [
          {'example/ng-selectize.js': 'ng-selectize.js'}
        ]
      }
    }

  });

  grunt.loadNpmTasks('grunt-contrib-jshint');
  grunt.loadNpmTasks('grunt-contrib-copy');
  grunt.loadNpmTasks('grunt-contrib-uglify');

  grunt.task.registerTask('default', ['jshint', 'uglify', 'copy:example']);

};
