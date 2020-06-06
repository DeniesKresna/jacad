export const state = {
  apiUrl: 'localhost:280/jacad/public/api/v1',
  data: [],
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