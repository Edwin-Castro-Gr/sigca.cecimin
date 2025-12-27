
<div class="container" style="max-width:680px;margin:30px auto;">
  <h3>2FA activado correctamente</h3>
  <?php if (!empty($msg)): ?>
    <div class="alert alert-success"><?= htmlspecialchars($msg) ?></div>
  <?php endif; ?>
  <p>Estos son tus <strong>códigos de respaldo</strong>. Guárdalos en un lugar seguro (imprime o guarda en un gestor de contraseñas). Cada código se puede usar <strong>una sola vez</strong>.</p>
  <pre style="background:#f8f8f8;border:1px solid #ddd;padding:12px;border-radius:6px;"><?= htmlspecialchars($codes) ?></pre>
  <p>Si pierdes acceso a tu app de autenticación, podrás entrar con uno de estos códigos.</p>
  <a href="<?= base_url('home/index') ?>" class="btn btn-primary">Ir al inicio</a>
</div>
