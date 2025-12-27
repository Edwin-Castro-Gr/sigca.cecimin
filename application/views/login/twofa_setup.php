
<div class="container" style="max-width:580px;margin:30px auto;">
  <h3>Activar 2FA (Google/Microsoft Authenticator)</h3>
  <?php if ($this->session->flashdata('msg')): ?>
    <div class="alert alert-info"><?= htmlspecialchars($this->session->flashdata('msg')) ?></div>
  <?php endif; ?>
  <ol>
    <li>Instala/abre tu app de autenticación (Google Authenticator, Microsoft Authenticator, Authy, 1Password, etc.).</li>
    <li>Elige "Agregar cuenta" → "Escanear código QR".</li>
    <li>Escanea este código:</li>
  </ol>
  <div style="text-align:center;margin:12px 0;">
    <img src="<?= $qr_src ?>" alt="QR 2FA" style="border:1px solid #ddd;padding:6px;border-radius:6px;" />
  </div>
  <p><strong>Secreto (por si no puedes escanear):</strong> <code><?= htmlspecialchars($secret) ?></code></p>
  <form action="<?= base_url('twofa/confirm') ?>" method="post" class="mt-3">
    <label>Código de 6 dígitos</label>
    <input type="text" name="code" placeholder="123456" required maxlength="6" class="form-control" style="max-width:220px;" />
    <button type="submit" class="btn btn-primary" style="margin-top:12px;">Confirmar</button>
    <a href="<?= base_url('home/index') ?>" class="btn btn-secondary" style="margin-top:12px;">Cancelar</a>
  </form>
</div>
