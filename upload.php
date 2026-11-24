<?php
// ===========================================================================
// LensHub upload handler  *** DELIBERATELY VULNERABLE ***
// [VULN] The "is this an image?" check trusts the CLIENT-SUPPLIED MIME type
//        ($_FILES['photo']['type']), which the uploader fully controls. It
//        does NOT check the real file content or the extension. So an attacker
//        uploads shell.php with Content-Type: image/png -> it passes -> it is
//        saved as shell.php in uploads/ -> PHP executes it = webshell / RCE.
// ===========================================================================
$msg = "";
$ok  = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['photo'])) {
    $allowed = ['image/jpeg', 'image/png', 'image/gif'];
    $type = $_FILES['photo']['type'];            // <-- attacker-controlled
    $name = basename($_FILES['photo']['name']);  // <-- original extension kept

    if (!in_array($type, $allowed)) {
        $msg = "Only JPEG, PNG or GIF images are allowed. (You sent: "
             . htmlspecialchars($type) . ")";
    } else {
        $dest = 'uploads/' . $name;              // [VULN] no extension check
        if (move_uploaded_file($_FILES['photo']['tmp_name'], $dest)) {
            $ok = true;
            $msg = "Uploaded. Your photo is live at <a href='/uploads/"
                 . htmlspecialchars($name) . "'>/uploads/" . htmlspecialchars($name) . "</a>";
        } else {
            $msg = "Upload failed.";
        }
    }
}
?><!doctype html><html lang="en"><head><meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Share a photo — LensHub</title>
<style>
 :root{--bg:#0b0b0f;--panel:#15151c;--line:#26262f;--text:#e7e7ee;--muted:#8b8b99;--accent:#e4b04a}
 *{margin:0;padding:0;box-sizing:border-box}
 body{background:var(--bg);color:var(--text);font-family:-apple-system,'Segoe UI',Roboto,sans-serif;line-height:1.6}
 .wrap{max-width:560px;margin:0 auto;padding:0 22px}
 header{border-bottom:1px solid var(--line)}
 .nav{display:flex;align-items:center;justify-content:space-between;height:64px;max-width:1080px;margin:0 auto;padding:0 22px}
 .brand{font-weight:800;font-size:1.25rem}.brand span{color:var(--accent)}
 .nav a{color:var(--muted);text-decoration:none;margin-left:22px}.nav a:hover{color:var(--text)}
 .card{background:var(--panel);border:1px solid var(--line);border-radius:16px;padding:34px;margin:60px auto}
 h2{font-size:1.5rem;margin-bottom:6px}
 p.sub{color:var(--muted);margin-bottom:22px;font-size:.95rem}
 input[type=file]{width:100%;padding:28px;border:2px dashed var(--line);border-radius:12px;
      background:#0f0f14;color:var(--muted);margin-bottom:18px}
 .btn{background:var(--accent);color:#1a1205;border:none;padding:11px 22px;border-radius:9px;
      font-weight:700;cursor:pointer;font-size:.95rem}
 .msg{margin-top:18px;padding:12px 14px;border-radius:9px;font-size:.92rem}
 .msg.ok{background:#102414;border:1px solid #1d4d2b;color:#86efac}
 .msg.no{background:#241012;border:1px solid #5a1f24;color:#fca5a5}
 .msg a{color:var(--accent)}
 a.back{color:var(--muted);text-decoration:none;font-size:.9rem;display:inline-block;margin-top:16px}
</style></head><body>
<header><div class="nav">
  <div class="brand">Lens<span>Hub</span></div>
  <nav><a href="/">Explore</a><a href="/upload.php">Share a photo</a></nav>
</div></header>
<div class="wrap"><div class="card">
  <h2>Share a photo</h2>
  <p class="sub">Drop an image and it goes straight to the community gallery. JPEG, PNG or GIF.</p>
  <form method="post" enctype="multipart/form-data">
    <input type="file" name="photo" required>
    <button class="btn">Upload to gallery</button>
  </form>
  <?php if ($msg): ?><div class="msg <?php echo $ok ? 'ok':'no'; ?>"><?php echo $msg; ?></div><?php endif; ?>
  <a class="back" href="/">← Back to gallery</a>
</div></div>
</body></html>
