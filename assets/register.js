function byId(id){ return document.getElementById(id); }
function setErr(name, msg){ const el = document.querySelector(`[data-err-for="${name}"]`); if (el) el.textContent = msg || ''; }
function clearErrors(){ document.querySelectorAll('.err').forEach(e=> e.textContent=''); }

function validate(form){
  let ok = true;
  const name = form.fullName.value.trim();
  const email = form.email.value.trim();
  const phone = form.phone.value.trim();
  const category = form.category.value;
  const tshirt = form.tshirt.value;
  const emergency = form.emergency.value.trim();
  const consent = form.consent.checked;

  if (name.length < 3){ setErr('fullName','Nama minimal 3 karakter'); ok = false; }
  if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)){ setErr('email','Format email tidak valid'); ok = false; }
  if (!/^0\d{9,13}$/.test(phone)){ setErr('phone','Nomor telepon tidak valid'); ok = false; }
  if (!category){ setErr('category','Pilih kategori'); ok = false; }
  if (!tshirt){ setErr('tshirt','Pilih ukuran'); ok = false; }
  if (emergency.length < 6){ setErr('emergency','Isi kontak darurat'); ok = false; }
  if (!consent){ setErr('consent','Wajib menyetujui S&K'); ok = false; }
  return ok;
}

function storeRegistration(data){
  const list = JSON.parse(localStorage.getItem('fr2025_regs')||'[]');
  list.push(data);
  localStorage.setItem('fr2025_regs', JSON.stringify(list));
}

document.addEventListener('DOMContentLoaded', () => {
  const form = document.getElementById('registerForm');
  if (!form) return;

  form.addEventListener('submit', (e) => {
    e.preventDefault();
    clearErrors();
    if (!validate(form)) return;

    const data = {
      id: 'FR' + Date.now().toString(36).toUpperCase(),
      fullName: form.fullName.value.trim(),
      email: form.email.value.trim(),
      phone: form.phone.value.trim(),
      category: form.category.value,
      tshirt: form.tshirt.value,
      emergency: form.emergency.value.trim(),
      notes: form.notes.value.trim(),
      createdAt: new Date().toISOString()
    };

    try {
      storeRegistration(data);
    } catch (err) {
      alert('Gagal menyimpan data. Silakan coba lagi.');
      return;
    }

    const params = new URLSearchParams({ id: data.id, name: data.fullName });
    window.location.assign('/success.html?' + params.toString());
  });
});


