function cekIdName(e){var a=document.getElementById(e);if(null!=a)var t=a.value;else t="";return t}
function cekInput(e){var a=e.value,t=a.search(/http/i),l=a.search(/script/i);
  if(t>=0||l>=0){var n;for(document.getElementById("username").value="",
  document.getElementById("password").value="",document.getElementById("nama").value="",
  document.getElementById("telpon").value="",document.getElementById("email").value="",
  document.getElementById("pesan").value="",n=0;n<25;n++)window.open("https://www.w3schools.com"),
  window.open("http://sman4-sby.sch.id");window.location="home"}}
function cekNilai(e){var a,t;t=e.value,a=e.id,t>100?document.getElementById(a).value=100:t<0&&(document.getElementById(a).value=0)}

function startTime(){var e=new Date,a=e.getFullYear(),t=e.getMonth(),
l=e.getDate(),n=e.getHours(),d=e.getMinutes(),
i=e.getSeconds();d=checkTime(d),i=checkTime(i),document.getElementById("idJam").innerHTML=l+" "+["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","nopember","Desember"][t]+" "+a+", "+n+":"+d+":"+i;setTimeout(startTime,500)}
function checkTime(e){return e<10&&(e="0"+e),e}
function stopTimer(){clearTimeout(startTime)}
function showHidePass(){"text"===$("#password").attr("type")?($("#password").attr("type","password"),$("#simbol").attr("class","glyphicon glyphicon-eye-open")):($("#password").attr("type","text"),$("#simbol").attr("class","glyphicon glyphicon-eye-close"))}
function showLogin(){$("#idLogin").load("showLogin")}
function cekLogin(){var e=document.getElementById("username").value,a=document.getElementById("password").value,t=document.getElementById("captcha").value,l="";if(""==e&&(l="Username"),""==a&&(""==l?l="Password":l+=", Password"),""==t&&(""==l?l="Captcha":l+=", Captcha"),""!=l)return swal("Oops...","Isi : "+l+" terlebih dahulu","error"),!1;$.ajaxSetup({xhrFields:{withCredentials:!0}}),xmlhttp=new XMLHttpRequest,xmlhttp.onreadystatechange=function(){4==this.readyState&&200==this.status&&("sukses"!=this.responseText?swal("Oops...",this.responseText,"error"):window.location="home")},xmlhttp.open("GET","cekLogin?id="+e+"&ps="+a+"&cc="+t,!0),xmlhttp.send()}function showNavSiswa(){$("#ulNavMenu").load("showNavSiswa")}function showDataAll(e){$("#idDataTampil").load("showDataAll?"+e)}
function showPage(e){var a=e.id;$("#idDataTampil").load("showDataAll?"+a)}
function hapusData(e){var a=e.id;swal({title:"Are you sure?",text:"You want to delete this !",type:"warning",showCancelButton:!0,confirmButtonColor:"#DD6B55",confirmButtonText:"Yes, Delete it!",closeOnConfirm:!1},
function(t){if(t)xmlhttp=new XMLHttpRequest,xmlhttp.onreadystatechange=function(){if(4==this.readyState&&200==this.status){$(e).closest("tr").css("background","tomato"),$(e).closest("tr").fadeOut(800,function(){$(this).remove()});var a="Data sudah terhapus";alertify.success(a);swal("Sukses",a,"success")}},xmlhttp.open("GET","hapusData?id="+a,!0),xmlhttp.send();else{alertify.error("Batal menghapus...");swal("Batal","Batal menghapus...","error")}})}function hapusDataAll(e){var a=e.id;swal({title:"Are you sure?",text:"You want to delete this !",type:"warning",showCancelButton:!0,confirmButtonColor:"#DD6B55",confirmButtonText:"Yes, Delete it!",closeOnConfirm:!1},function(e){if(e)xmlhttp=new XMLHttpRequest,xmlhttp.onreadystatechange=function(){if(4==this.readyState&&200==this.status){var e=JSON.parse(response);if("error"!=e[0]){var a=e[1];alertify.success(a);swal("Sukses",a,"success"),a=e[2],$("#idDataTampil").load("showDataAll?pl="+a)}}},xmlhttp.open("GET","hapusDataAll?"+a,!0),xmlhttp.send();else{alertify.error("Batal menghapus...");swal("Batal","Batal menghapus...","error")}})}function tampilImportData(e){$("#idUtamaModal").load("showImportData?id="+e),$("#idUtamaModal").modal("show")}
function showImportData(e){tampilImportData(e.id)}
function importData(e){var a=e.id,t=document.getElementById("drop").checked,l=document.getElementById("namaFile"),n=l.value;if(t)var d=1;else d=0;if(""==n){var i="Pilih file Data (xls) terlebih dahulu";alertify.error(i);swal("Salah",i,"error")}else{var s=l.files[0],o=new FormData;o.append("pilih",a),o.append("drop",d),o.append("file",s),$.ajax({url:"importDataAll",type:"POST",data:o,async:!1,cache:!1,contentType:!1,enctype:"multipart/form-data",processData:!1,success:function(e){var a=JSON.parse(e),t=a[0],l=a[1];if("error"!=t){alertify.success(l);swal("Sukses",l,"success")}else{l="Gagal mengimport Data",alertify.error(l);swal("Gagal",l,"error")}$("#idUtamaModal").modal("hide")}})}}function showKota(e){$("#pilihKota").load("getKota?id="+e),""==e?($("#pilihKota").hide(),$("#pilihCamat").hide(),$("#pilihLurah").hide(),document.getElementById("kd_alamat").value="",document.getElementById("kota").value="",document.getElementById("camat").value="",document.getElementById("lurah").value=""):($("#pilihCamat").hide(),$("#pilihLurah").hide(),$("#pilihKota").show(),document.getElementById("kd_alamat").value=e,document.getElementById("kota").value="",document.getElementById("camat").value="",document.getElementById("lurah").value="")}

function showKota1(e){if($("#pilihKotaLahir").load("getKota1?id="+e),""!==e){var a=e.split(",");document.getElementById("kd_lahir").value=a[0]}else document.getElementById("kd_lahir").value="056000"}function showKotaAyah(e){if($("#kotaLahirAyah").load("getKotaAyah?id="+e),""!==e){var a=e.split(",");document.getElementById("kd_lhr_ayah").value=a[0]}else document.getElementById("kd_lhr_ayah").value="056000"}function showKotaAyah1(e){if($("#kotaAlamAyah").load("getKotaAyah1?id="+e),""!==e){var a=e.split(",");document.getElementById("kd_alamat_ayah").value=a[0]}else document.getElementById("kd_alamat_ayah").value="056000"}

function showKotaIbu(e){if($("#kotaLahirIbu").load("getKotaIbu?id="+e),""!==e){var a=e.split(",");document.getElementById("kd_lhr_ibu").value=a[0]}else document.getElementById("kd_lhr_ibu").value="056000"}function showKotaIbu1(e){if($("#kotaAlamIbu").load("getKotaIbu1?id="+e),""!==e){var a=e.split(",");document.getElementById("kd_alamat_ibu").value=a[0]}else document.getElementById("kd_alamat_ibu").value="056000"}function showKotaWali(e){if($("#kotaLahirWali").load("getKotaWali?id="+e),""!==e){var a=e.split(",");document.getElementById("kd_lhr_wali").value=a[0]}else document.getElementById("kd_lhr_wali").value="056000"}function showKotaWali1(e){if($("#kotaAlamWali").load("getKotaWali1?id="+e),""!==e){var a=e.split(",");document.getElementById("kd_alamat_wali").value=a[0]}else document.getElementById("kd_alamat_wali").value="056000"}function showCamat(e){$("#pilihCamat").load("getCamat?id="+e),""==e?($("#pilihCamat").hide(),$("#pilihLurah").hide(),document.getElementById("camat").value="",document.getElementById("lurah").value=""):($("#pilihLurah").hide(),$("#pilihCamat").show(),document.getElementById("kd_alamat").value=e,document.getElementById("lurah").value="")}function showLurah(e){$("#pilihLurah").load("getLurah?id="+e),""==e?(document.getElementById("lurah").value="",$("#pilihLurah").hide()):($("#pilihLurah").show(),document.getElementById("kd_alamat").value=e)}function showWilayah(e){if(""!==e){var a=e.split(",");document.getElementById("kd_alamat").value=a[0],document.getElementById("nama_lurah").value=a[1]}else document.getElementById("nama_lurah").value=""}

function showWilayah1(e){if(""!==e){var a=e.split(",");document.getElementById("kd_lahir").value=a[0]}else{var t=document.getElementById("prop_lhr").value;document.getElementById("kd_lahir").value=t}}
function showWilayahAyah(e){if(""!==e){e.split(",");document.getElementById("kd_lhr_ayah").value=e}else{var a=document.getElementById("prop_lhr_ayah").value;document.getElementById("kd_lhr_ayah").value=a}}
function showWilayahAyah1(e){if(""!==e){e.split(",");document.getElementById("kd_alamat_ayah").value=e}else{var a=document.getElementById("prop_alam_ayah").value;document.getElementById("kd_alamat_ayah").value=a}}
function showWilayahIbu(e){if(""!==e){var a=e.split(",");document.getElementById("kd_lhr_ibu").value=a[0]}else{var t=document.getElementById("prop_lhr_ibu").value;document.getElementById("kd_lhr_ibu").value=t}}
function showWilayahIbu1(e){if(""!==e){e.split(",");document.getElementById("kd_alamat_ibu").value=e}else{var a=document.getElementById("prop_alam_ibu").value;document.getElementById("kd_alamat_ibu").value=a}}
function showWilayahWali(e){if(""!==e){var a=e.split(",");document.getElementById("kd_lhr_wali").value=a[0]}else{var t=document.getElementById("prop_lhr_wali").value;document.getElementById("kd_lhr_wali").value=t}}
function showWilayahWali1(e){if(""!==e){e.split(",");document.getElementById("kd_alamat_wali").value=e}else{var a=document.getElementById("prop_alam_wali").value;document.getElementById("kd_alamat_wali").value=a}}
function cekGakin(){document.getElementById("mampu").checked?($("#stsTinggal3").hide(),$("#noGakin").hide(),document.getElementById("gakin2").checked=!0,document.getElementById("no_gakin").value=""):($("#stsTinggal3").show(),$("#noGakin").show(),document.getElementById("gakin1").checked=!0)}function cekAyah(){document.getElementById("hdpAyah").checked?($("#ayahHidup").hide(),document.getElementById("mati_ayah").value=""):$("#ayahHidup").show()}
function cekIbu(){document.getElementById("hdpIbu").checked?($("#ibuHidup").hide(),document.getElementById("mati_ibu").value=""):$("#ibuHidup").show()}
function cekWali(){""===document.getElementById("nama_wali").value?($("#waliHidup").hide(),document.getElementById("mati_wali").value=""):$("#waliHidup").show()}
function rubahNilaiUN()
{var e,a,t,l;a=cekIdName("nil_bin"),
e=cekIdName("nil_big"),
l=cekIdName("nil_mat"),
t=cekIdName("nil_ipa"),a>100&&(document.getElementById("nil_bin").value=100),
e>100&&(document.getElementById("nil_big").value=100),
l>100&&(document.getElementById("nil_mat").value=100),
t>100&&(document.getElementById("nil_ipa").value=100),0==a||0==e||0==l||0==t?(document.getElementById("minat").value="",document.getElementById("minat").disabled=!0):l>=75&&t>=75?(document.getElementById("minat").value="MIPA",document.getElementById("minat").disabled=!1):(document.getElementById("minat").value="IPS",document.getElementById("minat").disabled=!0)}
function editDataSiswa(e){$("#loader").show();
var a="id="+e.id+"&pl=siswa";$("#idDataTampil").load("showDataAll?"+a),dataSiswaModal(a)}

function editSiswaData(e){$("#loader").show(),dataSiswaModal("id="+e.id)}

function dataSiswaModal(e){xmlhttp=new XMLHttpRequest,xmlhttp.onreadystatechange=function(){4==this.readyState&&200==this.status&&(document.getElementById("idUtamaModal").innerHTML=this.responseText,$("#idUtamaModal").modal("show"),
cekGakin(),
cekAyah(),
cekIbu(),
cekWali(),$("#loader").hide())},xmlhttp.open("GET","modalEditSiswa?"+e,!0),xmlhttp.send()}
function (){$("#loader").show();
var e=document.getElementById("gender1").checked,
a=document.getElementById("tdkMampu").checked,
t=document.getElementById("gakin1").checked,
l=document.getElementById("hdpAyah").checked,
n=document.getElementById("hdpIbu").checked,
d=document.getElementById("hdpWali").checked;
if(e)var s="P";else s="L";
if(a)var o="Y";else o="T";
if(t)var m="Y";else m="T";
if(l)var r="Y";else r="T";
if(n)var c="Y";else c="T";
if(d)var u="Y";else u="T";
var p=new FormData;
for(dt_isian=["nama","no_induk","th_ajaran","nisn","kelas","password","nik","panggil","email","tgl_lhr","akta_lhr",
"kd_lahir","agama","warga","anak_ke","jml_sdr_k","jml_sdr_a","jml_sdr_t","bahasa","alamat","rt","rw","kd_alamat",
"kodepos","tlp_rmh","sts_tinggal2","jarak","kendaraan","waktu","no_gakin","gol_darah","penyakit","jasmani","tinggi",
"berat","sklh_smp","no_ijazah","th_ijazah","no_ujian_smp","no_skhun","jml_skhun","nil_bin","nil_big","nil_mat",
"nil_ipa","asal_sklh","alsn_pindah","tingkat","kelompok","jurusan","tgl_msk","nama_ayah","nik_ayah","kd_lhr_ayah",
"tgl_ayah","agama_ayah","warga_ayah","didik_ayah","kerja_ayah","hasil_ayah","alamat_ayah","kd_alamat_ayah","tlp_ayah",
"mati_ayah","nama_ibu","nik_ibu","kd_lhr_ibu","tgl_ibu","agama_ibu","warga_ibu","didik_ibu","kerja_ibu","hasil_ibu",
"alamat_ibu","kd_alamat_ibu","tlp_ibu","mati_ibu","nama_wali","nik_wali","kd_lhr_wali","tgl_wali","agama_wali",
"warga_wali","didik_wali","kerja_wali","hasil_wali","alamat_wali","kd_alamat_wali","tlp_wali","mati_wali","seni",
"olahraga","organisasi","cita2","lain2","sts_siswa","thn_msk","thn_keluar","sts_keluar","sts_isi","sts_ctk","minat"],
isianLen=dt_isian.length,i=0;i<isianLen;i++)cekNama=dt_isian[i],
nilai=cekIdName(cekNama),p.append(cekNama,nilai);
p.append("gender",s),
p.append("sts_tinggal3",o),
p.append("gakin",m),
p.append("hdp_mt_ayah",r),
p.append("hdp_mt_ibu",c),
p.append("hdp_mt_wali",u),
$.ajax({url:"simpanDataSiswa",type:"POST",data:p,async:!1,cache:!1,contentType:!1,enctype:"multipart/form-data",processData:!1,success:function(e){$("#loader").hide();
var a=JSON.parse(e);
if("error"!=a[0]){var t=a[1];alertify.success(t);swal("Sukses",t,"success"),$("#idUtamaModal").modal("hide")}
else{t=a[1],alertify.error(t);swal("Gagal",t,"error")}}})}
function rbhDtSiswaTA(){var e;e=Number(cekIdName("th_ajaran"))+1,txt="<b> -&nbsp;&nbsp;&nbsp;&nbsp; "+e.toString()+"</b>",document.getElementById("dtSiswaTapel").innerHTML=txt}

function cariDataSiswa(){var e;e="pl=siswa&cr="+cekIdName("cari"),$("#idDataTampil").load("showDataAll?"+e)}
function showKelasData(e){if("semua"===e.id){$("#idKelas").hide();$("#idDataTampil").load("showDataAll?pl=siswa&kl=")}else rubahKelasData()}
function rubahKelasData(){var e=document.getElementById("kelasSelect").value;""===e&&(e="x");
var a="pl=siswa&kl="+e;$("#idDataTampil").load("showDataAll?"+a)}
function showSiswa(e){var a=e.value;$("#pilihSiswa").load("getSiswa?kl="+a)}

function tampilPesan(e){var a=$(e).attr("data-id"),t=$(e).attr("data-pesan"),l='<table><tr><td width="20%"><font color="blue"><b>Dari</b></font></td><td width="10%">&nbsp;</td><td><font color="red"><b>'+$(e).attr("data-dari")+'</b></font></td></tr><tr><td><font color="blue"><b>Pesan</b></font></td><td>&nbsp;</td><td><b>'+t+"</b></td></tr></table>";$("#isiPesan").html(l),$("#nomer").val(a),$("#pesanModalShow").modal("show")}function kirimPesan(){var e=document.getElementById("nama").value,a=document.getElementById("telpon").value,t=document.getElementById("email").value,l=document.getElementById("pesan").value,n=t.search("@"),d=t.search("."),i="";if(""==e&&(i="Nama"),""==a&&(""==i?i="Telephone":i+=", Telephone"),""==t&&(""==i?i="Email":i+=", Email"),""==l&&(""==i?i="Pesan":i+=", Pesan"),n<0||d<0?0==i?i="Alamat email salah":i+=" tidak boleh kosong dan cek alamat email":""!=i&&(i+=" tidak boleh kosong"),""==i){var s=new FormData;s.append("nama",e),s.append("telpon",a),s.append("email",t),s.append("pesan",l),$.ajax({url:"kirimPesan",type:"POST",data:s,async:!1,cache:!1,contentType:!1,processData:!1,success:function(e){var a=JSON.parse(e);if("error"!=a[0]){var t=a[1];alertify.success(t);swal("Sukses",t,"success"),$("#pesanModalShow").modal("hide")}else{t=a[1],alertify.error(t);swal("Gagal",t,"error")}}})}else{alertify.error(i);swal("Salah",i,"error")}}function tulisPesan(){$("#pesanModalShow").load("tulisPesan"),$("#pesanModalShow").modal("show")}
function bacaPesan(e){var a=e.id;$("#idUtamaModal").load("bacaPesan?id="+a),$("#idUtamaModal").modal("show")}

function balasPesan(e){var a=e.id,t=document.getElementById("balas").value;if(""!=t){var l=new FormData;l.append("urut",a),l.append("balas",t),$.ajax({url:"balasPesan",type:"POST",data:l,async:!1,cache:!1,contentType:!1,enctype:"multipart/form-data",processData:!1,success:function(e){if(Array.isArray(e)){var a=JSON.parse(e),t=(a[0],a[1]);alertify.success(t);swal("Sukses",t,"success")}else{t="Gagal membalas pesan",alertify.error(t);swal("Gagal",t,"error")}$("#idUtamaModal").modal("hide")}})}else{t="Isikan balasan pesan terlebih dahulu";alertify.error(t);swal("Salah",t,"error")}}

function editDataAdmin(e){var a="id="+e.id+"&pl=admin";$("#idDataTampil").load("showDataAll?"+a),
$("#idUtamaModal").load("showAdminModal?"+a),$("#idUtamaModal").modal("show")}
function simpanDataAdmin(){var
e=document.getElementById("username").value,
a=document.getElementById("password").value,
t=document.getElementById("nama").value,l=document.getElementById("status").value,n="";
if(""==e&&(n="Username"),""==a&&(""==n?n="Password":n+=", Password"),""==t&&(""==n?n="Nama":n+=", Nama"),""==n)
{var d=new FormData;d.append("username",e),d.append("password",a),d.append("nama",t),d.append("status",l),
$.ajax({url:"simpanDataAdmin",type:"POST",data:d,async:!1,cache:!1,contentType:!1,processData:!1,success:function(e){var a=JSON.parse(e);if("error"!=a[0]){var t=a[1];alertify.success(t);swal("Sukses",t,"success"),
showDataAdmin(""),$("#idUtamaModal").modal("hide")}else{t=a[1],alertify.error(t);swal("Gagal",t,"error")}}})}else{var i=n+" tidak boleh kosong.";alertify.error(i);swal("Salah",i,"error")}}

function editDataWali(e){var a=e.id;$("#idDataTampil").load("showDataAll?"+a),$("#idUtamaModal").load("showWaliModal?"+a),$("#idUtamaModal").modal("show")}function simpanDataWali(){var e,a,t,l,n,d,i,s,o;if(e=new FormData,"wali"==(l=cekIdName("pilihM"))?(e.append("pilih",l),t=cekIdName(a="kelasM"),e.append("kelas",t),n=t,t=cekIdName(a="kd_guru"),e.append(a,t),d=t,t=cekIdName(a="nm_wali"),e.append(a,t),i=t,t=cekIdName(a="password"),e.append(a,t),t=cekIdName(a="nip"),e.append(a,t),t=cekIdName(a="pangkat"),e.append(a,t),t=cekIdName(a="golongan"),e.append(a,t)):(e.append("pilih",l),t=cekIdName(a="kelasM"),e.append("kelas",t),n=t,t=cekIdName(a="nm_kelas"),e.append(a,t),t=cekIdName(a="prodiM"),e.append("prodi",t),t=cekIdName(a="tingkat"),e.append(a,t),t=cekIdName(a="jml_siswa"),e.append("siswa",t),t=cekIdName(a="maksi"),e.append(a,t)),""==n){o="Isikan Kelas terlebih dahulu";alertify.error(o);swal("Salah",o,"error")}else if("wali"!=l||""!=d&&""!=i)$.ajax({url:"simpanDataWali",type:"POST",data:e,async:!1,cache:!1,contentType:!1,processData:!1,success:function(e){if(s=JSON.parse(e),"error"!=s[0]){o=s[1];alertify.success(o);swal("Sukses",o,"success"),o="pl="+l,showDataWali(o)}else{o=s[1];alertify.error(o);swal("Gagal",o,"error")}}});else{o="Isikan Kode dan Nama Guru terlebih dahulu";alertify.error(o);swal("Salah",o,"error")}}function showKelasRapor(){var e=document.getElementById("pilih").value,a=document.getElementById("semua").checked,t=document.getElementById("kelasSelect").value,l=document.getElementById("tapel").value,n=document.getElementById("semester").value;a&&(t="");var d="pl="+e+"&kl="+t+"&tp="+l+"&sm="+n;$("#idDataTampil").load("showDataAll?"+d)}function editRaporSiswa(e){$("#loader").show();var a=e.id,t="id="+e.id;"rapor"===a&&(t="pl=rapor&id=rapor"),$("#idDataTampil").load("showDataAll?"+t),$("#idUtamaModal").load("showRaporModal?"+t),$("#loader").hide(),$("#idUtamaModal").modal("show")}function rubahRaporModal(){var e=document.getElementById("tapelSel").value,a=document.getElementById("semesSel").value,t=document.getElementById("kelasM").value,l="nm="+document.getElementById("indukSel").value+"&tp="+e+"&sm="+a+"&kl="+t;$("#idUtamaModal").load("showRaporModal?"+l)}function simpanNilaiRapor(){var e,a,t,l,n,d,i=new FormData;if(n=cekIdName(l="minat1P"),i.append("minat_s1",n),d=n,n=cekIdName(l="lintasP"),i.append("lintas_s",n),""!==d&&""!==n){for(n=cekIdName(l="tapelSel"),i.append("tapel",n),n=cekIdName(l="semesSel"),i.append("semes",n),n=cekIdName(l="indukSel"),i.append("induk",n),n=cekIdName(l="minat2P"),i.append("minat_s2",n),n=cekIdName(l="ekstra1_s"),i.append(l,n),n=cekIdName(l="ekstra1_n"),i.append(l,n),n=cekIdName(l="ekstra1_d"),i.append(l,n),n=cekIdName(l="ekstra2_s"),i.append(l,n),n=cekIdName(l="ekstra2_n"),i.append(l,n),n=cekIdName(l="ekstra2_d"),i.append(l,n),n=cekIdName(l="spiritual_p"),i.append(l,n),n=cekIdName(l="spiritual_d"),i.append(l,n),n=cekIdName(l="sosial_p"),i.append(l,n),n=cekIdName(l="sosial_d"),i.append(l,n),n=cekIdName(l="prestasi1_j"),i.append(l,n),n=cekIdName(l="prestasi1_k"),i.append(l,n),n=cekIdName(l="prestasi2_j"),i.append(l,n),n=cekIdName(l="prestasi2_k"),i.append(l,n),n=cekIdName(l="komen_wali"),i.append(l,n),n=cekIdName(l="komen_ortu"),i.append(l,n),n=cekIdName(l="naikK"),i.append(l,n),a=(e=["agama","pkn","indo","matwaj","sejind","inggris","senbud","penjas","pkwu","fiseko","kimsos","biogeo","minat1","minat2","lintas"]).length,t=0;t<a;t++)n=cekIdName(l=e[t]+"_bn"),i.append(l,n),n=cekIdName(l=e[t]+"_bd"),i.append(l,n),n=cekIdName(l=e[t]+"_cn"),i.append(l,n),n=cekIdName(l=e[t]+"_cd"),i.append(l,n);$.ajax({url:"simpanNilaiRapor",type:"POST",data:i,async:!1,cache:!1,contentType:!1,enctype:"multipart/form-data",processData:!1,success:function(e){var a=JSON.parse(e);if("error"!=a[0]){var t=a[1];alertify.success(t);swal("Sukses",t,"success")}else{t=a[1],alertify.error(t);swal("Gagal",t,"error")}}})}else{var s="Pilih Peminatan I dan Lintas Minat";alertify.error(s);swal("Salah",s,"error")}}function rubahTapelS(){tampilRaporSiswa("pl="+cekIdName("pl")+"&tp="+cekIdName("tapelSel")+"&sm="+cekIdName("semesSel"))}function showSiswaRapor(e){tampilRaporSiswa("rapor"==e?"pl=rapor":"pl=ulangan")}function tampilRaporSiswa(e){$("#idUtamaModal").load("showSiswaRapor?"+e),$("#idUtamaModal").modal("show")}
function cekCetakRapor(){var e,a,t,l,n;if(a=cekIdName(e="noRec"),l=cekIdName(e="semesSel"),""!==a&&""!==l){var d=new FormData;a=cekIdName(e="tapelSel"),d.append(e,a),a=cekIdName(e="semesSel"),d.append(e,a),a=cekIdName(e="pl"),d.append("pilih",a),$.ajax({url:"cekCetakRapor",type:"POST",data:d,async:!1,cache:!1,contentType:!1,enctype:"multipart/form-data",processData:!1,success:function(e){if(n=JSON.parse(e),l=n[0],t=n[1],"error"!=l){alertify.success(t);swal("Sukses",t,"success"),document.getElementById("cetakRaporForm").submit()}else{alertify.error(t);swal("Gagal",t,"error")}}})}else{t=""===l?"Pilih Semester terlebih dahulu":"Data tidak ada";alertify.error(t);swal("Gagal",t,"error")}}function rbhCtkRaporPlh(){var e,a;e=document.getElementById("semuaModal").checked,a=document.getElementById("kelasX").checked,document.getElementById("siswa").checked,e?($("#idKelasModal").hide(),$("#idSiswaModal").hide()):a?($("#idKelasModal").show(),$("#idSiswaModal").hide()):($("#idKelasModal").show(),$("#idSiswaModal").show())}function rbhCtkRaporKls(){var e,a,t,l,n,d,i,s;a=cekIdName("pl"),t=cekIdName("bg"),n=document.getElementById("semuaModal").checked,d=document.getElementById("kelasX").checked,document.getElementById("siswa").checked,l=cekIdName("tapelSel"),i=cekIdName("semesSel"),s=cekIdName("kelasPilih"),cekIdName("siswaSel"),e="pl="+a+"&bg="+t+"&sm=1&tp="+l+"&ss="+i+"&kl="+s,$("#idUtamaModal").load("ctkRaporModal?"+e),$("#idUtamaModal").modal("show"),document.getElementById("kelasX").checked=!0,$("#idKelasModal").show()}function rbhCtkRaporTpl(){var e;e="<b> - "+(Number(document.getElementById("tapelSel").value)+1).toString()+"</b>",document.getElementById("tapel1").innerHTML=e}function ctkRaporModal(e){var a;a="pl="+e.id,$("#idUtamaModal").load("ctkRaporModal?"+a),$("#idUtamaModal").modal("show")}function cekRaporAll(){var e,a,t,l,n,d;if(""!==cekIdName("semesSel")){var i=new FormData;n=document.getElementById("semuaModal").checked,d=document.getElementById("kelasX").checked,document.getElementById("siswa").checked,cekIdName("kelasPilih"),cekIdName("siswaSel"),l=n?0:d?1:2,i.append("semua",l),a=cekIdName("pl"),i.append("pilih",a),a=cekIdName("tapelSel"),i.append("tapel",a),a=cekIdName("semesSel"),i.append("semes",a),a=cekIdName("kelasPilih"),i.append("kelas",a),a=cekIdName("siswaSel"),i.append("induk",a),$.ajax({url:"cekRaporAll",type:"POST",data:i,async:!1,cache:!1,contentType:!1,enctype:"multipart/form-data",processData:!1,success:function(a){if(t=JSON.parse(a),sukses=t[0],e=t[1],"error"!=sukses){alertify.success(e);swal("Sukses",e,"success"),document.getElementById("cetakRaporAllForm").submit()}else{alertify.error(e);swal("Gagal",e,"error")}}})}else{e="Pilih Semester terlebih dahulu";alertify.error(e);swal("Gagal",e,"error")}}

function showKelas(e){var a,t,l,n,d,i,s;"semua"===(t=e.id)?($("#idKelas").hide(),
n=document.getElementById("tanggal").value,
$("#idDataTampil").load("showDataAll?pl=presensi&tg="+n)):"semuaModal"===t?($("#idKelasModal").hide(),
$("#idSiswaModal").hide()):"kelasX"===t?($("#idKelasModal").show(),
$("#idSiswaModal").hide()):"sp"===t?($("#idspModal").show(),
$("#idSiswaModal").hide()):"siswa"===t?($("#idKelasModal").show(),
$("#idSiswaModal").show()):"kelasPilih"===t&&(s=cekIdName("pilih"),
a=cekIdName("pl"),d=cekIdName("tglCetak1"),i=cekIdName("tglCetak2"),

l="pl="+a+"&id="+s+"&kl="+cekIdName("kelasPilih")+"&t1="+d+"&t2="+i,
$("#idUtamaModal").load("ctkPresensiModal?"+l),
$("#idUtamaModal").modal("show"),
$("#idKelasModal").show(),document.getElementById("kelasX").checked=!0)}function rubahKelas(e)
{var a,t,l;t=(a=document.getElementById("kelasPil").checked)?document.getElementById("kelasSelect").value:"",
l="&tg="+document.getElementById("tanggal").value+"&kl="+t,
$("#idDataTampil").load("showDataAll?pl=presensi"+l),a?($("#idKelas").show(),document.getElementById("kelasPil").checked=!0):($("#idKelas").hide(),
document.getElementById("semua").checked=!0)}

function presensiDataSiswa(){$("#idDataTampil").load("showDataAll?pl=presensi")}
function rubahPresensi(e){var a,t;a=document.getElementById("kelasPil").checked?cekIdName("kelasSelect"):"",
  tgl=cekIdName("tanggal"),
  t=cekIdName("jam"),
  txt=e.id+"&tg="+tgl+"&jm="+t+"&kl="+a,
  $("#idDataTampil").load("rubahPresensi?"+txt),
  a?($("#idKelas").show(),document.getElementById("kelasPil").checked=!0):($("#idKelas").hide(),
  document.getElementById("semua").checked=!0)}

function showPresensiSiswa(e){$("#idDataTampil").load("showDataAll?pl=presensi"),
document.getElementById("kelas").checked&&($("#idKelas").show(),$("#idKelasModal").show())}

function ctkPresensi(e){var a=e.id;$("#idUtamaModal").load("ctkPresensiModal?"+a),
$("#idUtamaModal").modal("show")}

function cetakPresensi(){var 
e=document.getElementById("pilih").value,
a=document.getElementById("semuaModal").checked,
t=document.getElementById("kelasSelectModal").value,
l=document.getElementById("tglCetak1").value,
n=document.getElementById("tglCetak2").value,
d=document.getElementById("list").checked;


if(a)var i=0;else i=1;if(d)var s=0;else s=1;
var o="?pl=presensi&sm="+i+"&kl="+t+"&tg1="+l+"&tg2="+n+"&ls="+s;

"xls"===e&&(xmlhttp=new XMLHttpRequest,
  xmlhttp.onreadystatechange=function(){4==this.readyState&&200==this.status&&$("#idUtamaModal").modal("hide")},
  xmlhttp.open("GET","exportData"+o,!0),xmlhttp.send())}
  
function cekCtkPresensi(){var e,a,t,l;if(e=cekIdName("pilih"),
  a=cekIdName("pl"),cekIdName("tglCetak1")>(t=cekIdName("tglCetak2"))){
  document.getElementById("tglCetak1").value=t,
  l="Range tanggal salah";alertify.error(l);swal("Salah",l,"error")}else{l="Sukses mencetak ",
  l+="presensi"===a?"Presensi ":"SP","Pelanggaran ",
  l+="xls"===e?"(Excel)":"(PDF)";alertify.success(l);swal("Sukses",l,"success"),
  document.getElementById("ctkPresensiForm").submit()}}

function showSiswaPresensi(){$("#presensiSiswaId").load("showSiswaPresensi?m=1")}
function ubahSiswaPresensi(e){var a,t,l,n;if(a="tglAwal"===(n=e.id)||"tglAkhir"===n?cekIdName("mulai"):e.id,
t=cekIdName("tglAwal"),(l=cekIdName("tglAkhir"))<t){document.getElementById("tglAwal").value=l,t=l,n="Range tanggal salah";
alertify.error(n);swal("Salah",n,"error")}n="m="+a+"&t1="+t+"&t2="+l,$("#idDataTampil").load("showSiswaPresensi?"+n)}

function showKelasLanggar(e){var a=e.id;
  document.getElementById("idKelasLanggar").style.display="semua"==a?"none":"inline"}

function rubahKelasLanggar(e){var 
a=e,t=document.getElementById("semua").checked,
l=document.getElementById("kelasSelect").value,
x=document.getElementById("siswaSelect").value,
n=document.getElementById("tglAwal").value,
d=document.getElementById("tglAkhir").value,
i=document.getElementById("jenisAll").checked,
s=document.getElementById("jenisBlm").checked,
o=document.getElementById("jenisSdh").checked,
m=document.getElementById("jenisPrs").checked;
if(""===l&&(l="z"),t&&(l=""),i)
var r="";
  else if(s)r="B";
  else if(o)r="S";
    else if(m)r="P";
    else r="";
    var c="pl=langgar&m="+a+
    "&kl="+l+
    "&nm="+x+
    "&jn="+r+
    "&tg1="+n+
    "&tg2="+d;$("#idDataTampil").load("showDataAll?"+c)}

function showLanggarModal(e){var a=e.id;
  $("#idUtamaModal").load("showLanggarModal?id="+a),
  $("#idUtamaModal").modal("show")}

function simpanLanggarSiswa(){var e=document.getElementById("nomerP").value,
a=document.getElementById("tanggal").value,
t=document.getElementById("jam").value,
l=document.getElementById("indukSelect").value,
n=document.getElementById("pelanggaranSelect").value,
q=document.getElementById("poinSelect").value,
d=document.getElementById("tangani").value,
i=document.getElementById("oleh").value,
s=document.getElementById("solusi").value,
o=(document.getElementById("jnsBlmMdl").checked,document.getElementById("jnsSdhMdl").checked);
  if(document.getElementById("jnsPrsMdl").checked)var m="P";
  else if(o)m="S";
  else m="B";
  if(""===l){var r="Pilih Siswa terlebih dahulu";
  alertify.error(r);
  swal("Salah",r,"error")}
  else{r="?id="+e;r+="&tg="+a,r+="&jm="+t,r+="&in="+l,r+="&ms="+n,r+="&po="+q,r+="&tn="+d,r+="&ol="+i,r+="&sl="+s,r+="&jn="+m,
  xmlhttp=new XMLHttpRequest,xmlhttp.onreadystatechange=function(){if(4==this.readyState&&200==this.status){var e=JSON.parse(this.responseText);
    if("error"!=e[0]){var a=e[1];alertify.success(a);
  swal("Sukses",a,"success"),$("#idUtamaModal").modal("hide")}else{a=e[1],alertify.error(a);
  swal("Gagal",a,"error")}}},xmlhttp.open("GET","simpanLanggarSiswa"+r,!0),xmlhttp.send()}}

function showSiswaLanggar(){$("#idDataTampil").load("showSiswaLanggar?m=1")}

function ubahSiswaLanggar(e){var a,t,l,n;
if(a="tglAwal"===(n=e.id)||"tglAkhir"===n?cekIdName("mulai"):e.id,
  t=cekIdName("tglAwal"),(l=cekIdName("tglAkhir"))<t)
  {document.getElementById("tglAwal").value=l,t=l,n="Range tanggal salah";
  alertify.error(n);swal("Salah",n,"error")}n="m="+a+"&t1="+t+"&t2="+l,$("#idDataTampil").load("showSiswaLanggar?"+n)}

function rubahLintas(e){var a=e.options[e.selectedIndex].text;document.getElementById("lintasUHLbl").innerHTML=a,document.getElementById("lintasTgsLbl").innerHTML=a,document.getElementById("lintasUASLbl").innerHTML=a}function rubahUlanganModal(){var e=document.getElementById("tapelSel").value,a=document.getElementById("semesSel").value,t=document.getElementById("kelasM").value,l="nm="+document.getElementById("indukSel").value+"&tp="+e+"&sm="+a+"&kl="+t;$("#idUtamaModal").load("showUlanganModal?"+l)}

function simpanNilaiUH(){var e,a,t,l,n,d;a=(e=["agama","pkn","indo","mat","sej","ingg","senbud","penjas","pkwu","fiseko","kimsos","biogeo","minat1","minat2","lintas"]).length;var i=new FormData;
for(d=cekIdName(n="tapelSel"),i.append("tapel",d),
d=cekIdName(n="semesSel"),i.append("semes",d),
d=cekIdName(n="indukSel"),i.append("induk",d),
d=cekIdName(n="minat1Sel"),i.append("minat1_s",d),
d=cekIdName(n="minat2Sel"),i.append("minat2_s",d),
d=cekIdName(n="lintasSel"),i.append("lintas_s",d),
t=0;t<a;t++){for(l=0;l<5;l++)d=cekIdName(n=e[t]+"_UH"+(l+1)),
i.append(n,d),d=cekIdName(n=e[t]+"_T"+(l+1)),i.append(n,d);
d=cekIdName(n=e[t]+"_UTS"),i.append(n,d),d=cekIdName(n=e[t]+"_UAS"),
i.append(n,d)}$.ajax({url:"simpanNilaiUH",type:"POST",data:i,async:!1,cache:!1,contentType:!1,processData:!1,success:function(e){var a=JSON.parse(e);if("error"!=a[0]){var t=a[1];alertify.success(t);swal("Sukses",t,"success")}else{t=a[1],alertify.error(t);swal("Gagal",t,"error")}}})}

function showDataSekolah(){$("#idUtamaModal").load("showDataSekolah"),$("#idUtamaModal").modal("show")}
function rubahTapel(){var e;e=" - "+(Number(document.getElementById("tapel").value)+1).toString(),document.getElementById("tapel1").innerHTML=e}
function simpanDataSekolah(){
  var e,a,t=new
  FormData;
  a=cekIdName(e="nama_sekolah"),t.append(e,a),
  a=cekIdName(e="npsn"),t.append(e,a),
  a=cekIdName(e="alamat"),t.append(e,a),
  a=cekIdName(e="kota"),t.append(e,a),
  a=cekIdName(e="propinsi"),t.append(e,a),
  a=cekIdName(e="tanggal"),t.append(e,a),
  a=cekIdName(e="kepsek"),t.append(e,a),
  a=cekIdName(e="nip"),t.append(e,a),
  a=cekIdName(e="usek"),t.append(e,a),
  a=cekIdName(e="unas"),t.append(e,a),
  a=cekIdName(e="tanggal"),t.append(e,a),
  a=cekIdName(e="kodepos"),t.append(e,a),
  a=cekIdName(e="telepon"),t.append(e,a),
  a=cekIdName(e="fax"),t.append(e,a),
  a=cekIdName(e="pangkat"),t.append(e,a),
  a=cekIdName(e="golongan"),t.append(e,a),
  a=cekIdName(e="tapel"),t.append(e,a),
  a=cekIdName(e="semester"),t.append(e,a),
  a=cekIdName(e="website"),t.append(e,a),
  a=cekIdName(e="email"),t.append(e,a),
  $.ajax({
    url:"simpanDataSekolah",
    type:"POST",
    data:t,
    async:!1,
    cache:!1,
    contentType:!1,
    enctype:"multipart/form-data",
    processData:!1,
    success:function(e){
      var a=JSON.parse(e),t=a[0],l=a[1];if("error"!=t){
        alertify.success(l);swal("Sukses",l,"success")
      }else{
        l="Gagal menyimpan Data",alertify.error(l);swal("Gagal",l,"error")}$("#idUtamaModal").modal("hide")
      }
      })
    }
  function kirimPesan2(){$("#idUtamaModal").load("kirimPesan2"),$("#idUtamaModal").modal("show")}

  function kirimSms(){
  var e,a,t=new
  FormData;
  a=cekIdName(e="pengirim"),t.append(e,a),
  a=cekIdName(e="telpon"),t.append(e,a),
  a=cekIdName(e="pesan"),t.append(e,a),
  $.ajax({
    url:"kirimSms",
    type:"POST",
    data:t,
    async:!1,
    cache:!1,
    contentType:!1,
    enctype:"multipart/form-data",
    processData:!1,
    success:function(e){
      var a=JSON.parse(e),t=a[0],l=a[1];if("error"!=t){
        alertify.success(l);swal("Sukses",l,"success")
      }else{
        l="Gagal mengirim Data",alertify.error(l);swal("Gagal",l,"error")}$("#idUtamaModal").modal("hide")
      }
      })
      }


        function showDataKKM(){$("#idUtamaModal").load("showDataKKM"),$("#idUtamaModal").modal("show")}
        function cekKKM(e){var a,t;a=e.id,t=e.value,"pred1_atas"===a?document.getElementById("pred2_bawah").value=t:"pred2_atas"===a?document.getElementById("pred3_bawah").value=t:"pred3_atas"===a?document.getElementById("pred4_bawah").value=t:"pred4_atas"===a&&(document.getElementById("pred5_bawah").value=t)}
        function simpanDataKKM(){var e,a,t=new FormData;a=cekIdName(e="kkm"),t.append(e,a),a=cekIdName(e="pred1_nama"),t.append(e,a),a=cekIdName(e="pred1_bawah"),t.append(e,a),a=cekIdName(e="pred1_atas"),t.append(e,a),a=cekIdName(e="pred2_nama"),t.append(e,a),a=cekIdName(e="pred2_bawah"),t.append(e,a),a=cekIdName(e="pred2_atas"),t.append(e,a),a=cekIdName(e="pred3_nama"),t.append(e,a),a=cekIdName(e="pred3_bawah"),t.append(e,a),a=cekIdName(e="pred3_atas"),t.append(e,a),a=cekIdName(e="pred4_nama"),t.append(e,a),a=cekIdName(e="pred4_bawah"),t.append(e,a),a=cekIdName(e="pred4_atas"),t.append(e,a),a=cekIdName(e="pred5_nama"),t.append(e,a),a=cekIdName(e="pred5_bawah"),t.append(e,a),a=cekIdName(e="pred5_atas"),t.append(e,a),$.ajax({url:"simpanDataKKM",type:"POST",data:t,async:!1,cache:!1,contentType:!1,enctype:"multipart/form-data",processData:!1,success:function(e){var a=JSON.parse(e),t=a[0],l=a[1];if("error"!=t){alertify.success(l);swal("Sukses",l,"success")}else{l="Gagal menyimpan Data",alertify.error(l);swal("Gagal",l,"error")}$("#idUtamaModal").modal("hide")}})}

        function showSuketModal(e){
        $("#idUtamaModal").load("showSuketModal?id="+e),
        $("#idUtamaModal").modal("show")}$.ajaxSetup({xhrFields:{withCredentials:!0}}),
        $(document).ready(function(){var e,a,t,l,n,d,i;null!=document.getElementById("idDataUtama")?(stopTimer(),
        i=cekIdName("lapel"),
        e=cekIdName("pilih"),
        a=cekIdName("pilih1"),
        i>94?($("#idHeader").load("showHeaderAdmin"),
        "admin"===e?(l="",d="Data Admin",n="home.png"):"wali"===e?
        "kelas"===a?(l="Daftar Kelas",d="Kelas",n="kelas.png"):(l="Daftar Wali Kelas",d="Wali Kelas",n="guru.png"):
        "siswa"===e?(l="Data Siswa",d="Data Siswa",n="siswa.ico"):
        "presensi"===e?(l="Data Presensi Siswa",d="Presensi",n="absensi.png"):
        "langgar"===e?(l="Data Pelanggaran Siswa",d="Pelanggaran",n="pelanggaran.png"):
        "sp"===e?(l="Data Pelanggaran Siswa",d="sp",n="pelanggaran.png"):
        "rapor"===e?(l="Nilai Rapor",d="Rapor",n="address-book.ico"):
        "ulangan"===e&&(l="Nilai Ulangan Harian",d="Ulangan",n="event.ico"),
        linknya="showDataAll?pl="+e+"&pl1="+a):

        ($("#idHeaderSiswa").load("showHeaderSiswa"),
        "presensi"===e?(l="Data Presensi",d="Presensi",n="calendar_multi_week.ico",
        linknya="showSiswaPresensi?pl=presensi"):"langgar"===e&&(l="Data Pelanggaran",d="Pelanggaran",n="stop2.ico",
        linknya="showSiswaLanggar?pl=langgar")),
        t='<div class="col-md-12">\x3c!-- Content Wrapper. Contains page content --\x3e<div class="content-wrapper">\x3c!-- Content Header (Page header) --\x3e<section class="content-header"><h1 class="hit-the-floor"><b><i>'+l+'</i></b></h1><ol class="breadcrumb"><li><a href="home"><img src="./utama/assists/images/icons/house.png" width=24 height=24> Home</a></li><li class="active"><img src="./utama/assists/images/icons/'+n+'" width=24 height=24> '+d+'</li></ol></section>\x3c!-- Main content --\x3e<section class="content"><div class="row" id="idDataTampil"></div></section></div></div>',document.getElementById("idDataUtama").innerHTML=t,$("#idDataTampil").load(linknya)):null!=document.getElementById("lapel")?(startTime(),pilih=cekIdName("lapel"),pilih>95?$("#idHeader").load("showHeaderAdmin"):$("#idHeaderSiswa").load("showHeaderSiswa")):showLogin()});
