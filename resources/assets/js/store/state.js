export const state = {
  apiUrl: 'http://192.168.100.23:280/jacad/public/api/v1',
  siteUrl: 'http://192.168.100.23:280/jacad/public/',
  isLoading: false,
  isSideBar: false,
  menus: [
  	{'text':'Beranda', 'path':'/'},
  	{'text':'Tentang', 'path':'/tentang'},
  	{'text':'Kelas', 'child':[
  		{'text': 'Daftar Kelas', 'path':'Kelas'},
  		{'text': 'Testimoni', 'path':'#'}
  	]}
  ]
};