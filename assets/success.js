function getLatest(regs){ return regs && regs.length ? regs[regs.length - 1] : null; }

function renderSummary(reg){
  const el = document.getElementById('summary');
  if (!el) return;
  if (!reg){ el.innerHTML = '<p class="muted">Data pendaftaran tidak ditemukan.</p>'; return; }
  el.innerHTML = `
    <div class="row"><div class="key">ID Pendaftaran</div><div class="val">${reg.id}</div></div>
    <div class="row"><div class="key">Nama</div><div class="val">${reg.fullName}</div></div>
    <div class="row"><div class="key">Email</div><div class="val">${reg.email}</div></div>
    <div class="row"><div class="key">Telepon</div><div class="val">${reg.phone}</div></div>
    <div class="row"><div class="key">Kategori</div><div class="val">${reg.category}</div></div>
    <div class="row"><div class="key">Ukuran Kaos</div><div class="val">${reg.tshirt}</div></div>
    <div class="row"><div class="key">Kontak Darurat</div><div class="val">${reg.emergency}</div></div>
    <div class="row"><div class="key">Waktu Daftar</div><div class="val">${new Date(reg.createdAt).toLocaleString('id-ID')}</div></div>
  `;
}

async function downloadPNG(){
  const summary = document.querySelector('.card.center');
  if (!summary) return;
  const { toPng } = await import('https://cdn.skypack.dev/html-to-image');
  try {
    const dataUrl = await toPng(summary);
    const a = document.createElement('a');
    a.href = dataUrl;
    a.download = 'FunRun-Registration.png';
    a.click();
  } catch (e){
    alert('Gagal membuat gambar. Coba tangkap layar sebagai alternatif.');
  }
}

document.addEventListener('DOMContentLoaded', () => {
  const params = new URLSearchParams(location.search);
  const id = params.get('id');
  const regs = JSON.parse(localStorage.getItem('fr2025_regs')||'[]');
  const reg = id ? regs.find(r => r.id === id) : getLatest(regs);
  renderSummary(reg);
  const btn = document.getElementById('downloadBtn');
  if (btn) btn.addEventListener('click', downloadPNG);
});


