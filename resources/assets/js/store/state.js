export const state = {
    urls: {
        host: {
            master: 'http://192.168.100.23:280',
            jonathan: 'http://192.168.56.1'
        },
        api: '/jacad/public/api/v1',
        site: '/jacad/public'
    },
    isLoading: false,
    isSideBar: false,
    menus: [
        { 
            'text': 
            'Beranda', 'path': '/' 
        },
        { 
            'text': 'Tentang', 
            'path': '/tentang' 
        },
        { 
            'text': 'Kelas', 
            'child': [
                { 
                    'text': 'Daftar Kelas', 
                    'path': 'Kelas' 
                },
                { 
                    'text': 'Testimoni', 
                    'path': '#'
                }
            ]
        }
    ]
};