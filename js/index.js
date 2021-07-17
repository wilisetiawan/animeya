const back2Top = document.querySelector("#back2Top");

if (back2Top !== null) {
  back2Top.addEventListener("click", (e) => {
    e.preventDefault();
    window.scroll({ top: 0, left: 0, behavior: "smooth" });
  });
}

function tampilPassword() {
  let x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}

function validateForm() {
  let a = document.forms["my-form"]["nama_pt"].value;
  if (!/^[a-z A-Z]*$/g.test(a) || a.trim() == "" || a.trim().length < 3) {
    Swal.fire({
      icon: "error",
      title: "ERROR",
      text: "Nama Perguruan Tinggi tidak boleh mengandung angka!",
    });
    return false;
  }

  let b = document.forms["my-form"]["penanggungjawab"].value;
  if (!/^[a-z A-Z]*$/g.test(b) || b.trim() == "" || b.trim().length < 3) {
    Swal.fire({
      icon: "error",
      title: "ERROR",
      text: "Nama Penanggungjawab tidak boleh mengandung angka!",
    });
    return false;
  }

  let c = document.forms["my-form"]["email"].value;
  if (!/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/g.test(c) || c.trim() == "" || c.trim().length < 3) {
    Swal.fire({
      icon: "error",
      title: "ERROR",
      text: "Harap isi Email dengan benar!",
    });
    return false;
  }

  let d = document.forms["my-form"]["telp"].value;
  if (!/(\+62 ((\d{3}([ -]\d{3,})([- ]\d{4,})?)|(\d+)))|(\(\d+\) \d+)|\d{3}( \d+)+|(\d+[ -]\d+)|\d+$/g.test(d) ||
    d.trim() == "" || d.trim().length < 3) {
    Swal.fire({
      icon: "error",
      title: "ERROR",
      text: "Harap isi Nomor Telepon dengan benar!",
    });
    return false;
  }
}

function validateLogin() {
  let a = document.forms["form-login"]["username"].value;
  if (a.trim() == "") {
    Swal.fire({
      icon: "error",
      title: "ERROR",
      text: "Username tidak boleh kosong!",
    });
    return false;
  }

  let b = document.forms["form-login"]["password"].value;
  if (b.trim() == "") {
    Swal.fire({
      icon: "error",
      title: "ERROR",
      text: "Password tidak boleh kosong!",
    });
    return false;
  }
}

// DOM Panduan
const panduan1 = document.getElementById('panduan1');
const svg1 = panduan1.querySelector('#panduan1 .svg1');
const buttonp1 = panduan1.querySelector('#panduan1 .buttonp1');
const p1 = buttonp1.querySelector('#panduan1 .buttonp1 p');

panduan1.addEventListener('mouseenter', function () {
	panduan1.classList.remove('bg-white', 'text-black');
	panduan1.classList.add('bg-green-500', 'text-white');

  svg1.classList.remove('text-green-600', 'text-opacity-80');
  svg1.classList.add('text-white');

  buttonp1.classList.remove('bg-green-500', 'hover:bg-green-600');
  buttonp1.classList.add('bg-white', 'hover:bg-gray-500');

  p1.classList.remove('text-white');
  p1.classList.add('text-black');
})

panduan1.addEventListener('mouseleave', function () {
	panduan1.classList.add('bg-white', 'text-black');
	panduan1.classList.remove('bg-green-500', 'text-white');

  svg1.classList.add('text-green-600', 'text-opacity-80');
  svg1.classList.remove('text-white');

  buttonp1.classList.add('bg-green-500', 'hover:bg-green-600');
  buttonp1.classList.remove('bg-white', 'hover:bg-gray-500');

  p1.classList.add('text-white');
  p1.classList.remove('text-black');
})

const panduan2 = document.getElementById('panduan2');
const svg2 = panduan2.querySelector('#panduan2 .svg2');
const buttonp2 = panduan2.querySelector('#panduan2 .buttonp2');
const p2 = buttonp2.querySelector('#panduan2 .buttonp2 p');

panduan2.addEventListener('mouseenter', function () {
	panduan2.classList.remove('bg-white', 'text-black');
	panduan2.classList.add('bg-green-500', 'text-white');

  svg2.classList.remove('text-green-600', 'text-opacity-80');
  svg2.classList.add('text-white');

  buttonp2.classList.remove('bg-green-500', 'hover:bg-green-600');
  buttonp2.classList.add('bg-white', 'hover:bg-gray-500');

  p2.classList.remove('text-white');
  p2.classList.add('text-black');
})

panduan2.addEventListener('mouseleave', function () {
	panduan2.classList.add('bg-white', 'text-black');
	panduan2.classList.remove('bg-green-500', 'text-white');

  svg2.classList.add('text-green-600', 'text-opacity-80');
  svg2.classList.remove('text-white');

  buttonp2.classList.add('bg-green-500', 'hover:bg-green-600');
  buttonp2.classList.remove('bg-white', 'hover:bg-gray-500');

  p2.classList.add('text-white');
  p2.classList.remove('text-black');
})

const panduan3 = document.getElementById('panduan3');
const svg3 = panduan3.querySelector('#panduan3 .svg3');
const buttonp3 = panduan3.querySelector('#panduan3 .buttonp3');
const p3 = buttonp3.querySelector('#panduan3 .buttonp3 p');

panduan3.addEventListener('mouseenter', function () {
	panduan3.classList.remove('bg-white', 'text-black');
	panduan3.classList.add('bg-green-500', 'text-white');

  svg3.classList.remove('text-green-600', 'text-opacity-80');
  svg3.classList.add('text-white');

  buttonp3.classList.remove('bg-green-500', 'hover:bg-green-600');
  buttonp3.classList.add('bg-white', 'hover:bg-gray-500');

  p3.classList.remove('text-white');
  p3.classList.add('text-black');
})

panduan3.addEventListener('mouseleave', function () {
	panduan3.classList.add('bg-white', 'text-black');
	panduan3.classList.remove('bg-green-500', 'text-white');

  svg3.classList.add('text-green-600', 'text-opacity-80');
  svg3.classList.remove('text-white');

  buttonp3.classList.add('bg-green-500', 'hover:bg-green-600');
  buttonp3.classList.remove('bg-white', 'hover:bg-gray-500');

  p3.classList.add('text-white');
  p3.classList.remove('text-black');
})


const mobileToggle = document.getElementById('mtog');
const mobileNav = document.getElementById('mnav');

mobileToggle.addEventListener('click', function() {
  mobileNav.classList.remove('hidden');
  mobileNav.classList.add('visible');
})

const buatID = (hl, id) => {
  Swal.fire({
  title: 'Yakin?',
  text: 'Ingin menghapus data ini?',
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Ya, hapus!'
  }).then(function(result) {
      if (result.isConfirmed) {
          window.location = `hapus.php?halaman=${hl}&id=${id}`;
      }
  })
}