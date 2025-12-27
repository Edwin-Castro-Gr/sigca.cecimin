

<div class="container">
  <h3>Activar 2FA (Google Authenticator)</h3>
  <p>Escanea este QR en tu app de autenticación y escribe el código de 6 dígitos.</p>
  <?= $qr_src ?>
  <p><strong>Secreto:</strong> <?= htmlspecialchars($secret) ?></p>

  <?= base_url(" method="post">
    <input type="text" name="code" placeholder="Código de 6 dígitos" required maxlength="6" />
    <button type="submit">Confirmar</button>
  </form>
</div>

