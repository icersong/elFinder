define('elFinderConfig', {
    // elFinder options (REQUIRED)
    // Documentation for client options:
    // https://github.com/Studio-42/elFinder/wiki/Client-configuration-options
    defaultOpts: {
        // cssAutoLoad : ['themes/windows-10/css/theme.css'],
        cssAutoLoad: ['themes/Material/css/theme-gray.css'],
        url: 'php/connector.minimal.php', // or connector.maximal.php : connector URL (REQUIRED)
        height: '100%',
        commands: [
            'home', 'up', 'back', 'forward', 'reload',
            'netmount',
            'mkdir', 'mkfile', 'upload',
            'open', 'download', 'getfile',
            'undo', 'redo',
            'copy', 'cut', 'paste', 'rm', 'empty', 'hide',
            'duplicate', 'rename', 'edit', 'resize', 'chmod',
            'selectall', 'selectnone', 'selectinvert',
            'quicklook', 'info',
            'extract', 'archive',
            'search',
            'view', 'sort',
            'preference', // 'help',
            // 'fullscreen'
        ],
        contextmenu: {
            // navbarfolder menu
            navbar: ['open', '|', 'copy', 'cut', 'paste', 'duplicate', '|', 'rm', '|', 'info'],
            // current directory menu
            cwd: ['reload', 'back', '|', 'upload', 'mkdir', 'mkfile', 'paste', '|', 'sort', '|', 'info'],
            // current directory file menu
            files: ['getfile', '|', 'custom', 'quicklook', '|', 'download', '|',
                'copy', 'cut', 'paste', 'duplicate', '|', 'rm', '|',
                'edit', 'rename', 'resize', '|', 'archive', 'extract', '|', 'info']
        },
        commandsOptions: {
            edit: {
                extraOptions: {
                    // set API key to enable Creative Cloud image editor
                    // see https://console.adobe.io/
                    creativeCloudApiKey: '',
                    // browsing manager URL for CKEditor, TinyMCE
                    // uses self location with the empty value
                    managerUrl: ''
                }
            },
            quicklook: {
                // to enable CAD-Files and 3D-Models preview with sharecad.org
                sharecadMimes: ['image/vnd.dwg', 'image/vnd.dxf', 'model/vnd.dwf', 'application/vnd.hp-hpgl', 'application/plt', 'application/step', 'model/iges', 'application/vnd.ms-pki.stl', 'application/sat', 'image/cgm', 'application/x-msmetafile'],
                // to enable preview with Google Docs Viewer
                googleDocsMimes: ['application/pdf', 'image/tiff', 'application/vnd.ms-office', 'application/msword', 'application/vnd.ms-word', 'application/vnd.ms-excel', 'application/vnd.ms-powerpoint', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/vnd.openxmlformats-officedocument.presentationml.presentation', 'application/postscript', 'application/rtf'],
                // to enable preview with Microsoft Office Online Viewer
                // these MIME types override "googleDocsMimes"
                officeOnlineMimes: ['application/vnd.ms-office', 'application/msword', 'application/vnd.ms-word', 'application/vnd.ms-excel', 'application/vnd.ms-powerpoint', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/vnd.openxmlformats-officedocument.presentationml.presentation', 'application/vnd.oasis.opendocument.text', 'application/vnd.oasis.opendocument.spreadsheet', 'application/vnd.oasis.opendocument.presentation']
            }
        },
        // bootCalback calls at before elFinder boot up
        bootCallback: function(fm, extraObj) {
            /* any bind functions etc. */
            fm.bind('init', function() {
                // any your code
            });
            // for example set document.title dynamically.
            var title = document.title;
            fm.bind('open', function() {
                var path = '';
                    var cwd = fm.cwd();
                if (cwd) {
                    path = fm.path(cwd.hash) || null;
                }
                document.title = path ? path + ':' + title : title;
            }).bind('destroy', function() {
                document.title = title;
            });
        }
    },
    managers: {
        // 'DOM Element ID': { /* elFinder options of this DOM Element */ }
        elfinder: {}
    }
});
