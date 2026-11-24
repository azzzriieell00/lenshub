<?php
// ===========================================================================
// LensHub - a photo-sharing community.  *** DELIBERATELY VULNERABLE ***
// Defacement practice target (technique: upload -> webshell -> RCE -> overwrite
// this very file). LOCALHOST ONLY. Never deploy publicly.
// ===========================================================================
$imgs = array_values(array_filter(scandir('uploads'), function($f){
    return preg_match('/\.(jpe?g|png|gif)$/i', $f);
}));
?><!doctype html><html lang="en"><head><meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>LensHub — Share your shots</title>
<style>
 :root{--bg:#0b0b0f;--panel:#15151c;--line:#26262f;--text:#e7e7ee;--muted:#8b8b99;--accent:#e4b04a}
 *{margin:0;padding:0;box-sizing:border-box}
 body{background:var(--bg);color:var(--text);font-family:-apple-system,'Segoe UI',Roboto,sans-serif;line-height:1.6}
 .wrap{max-width:1080px;margin:0 auto;padding:0 22px}
 header{position:sticky;top:0;background:rgba(11,11,15,.85);backdrop-filter:blur(8px);
        border-bottom:1px solid var(--line);z-index:10}
 .nav{display:flex;align-items:center;justify-content:space-between;height:64px}
 .brand{font-weight:800;font-size:1.25rem;letter-spacing:.02em}
 .brand span{color:var(--accent)}
 .nav a{color:var(--muted);text-decoration:none;margin-left:22px;font-size:.95rem}
 .nav a:hover{color:var(--text)}
 .btn{background:var(--accent);color:#1a1205;padding:9px 18px;border-radius:8px;font-weight:700;
      text-decoration:none;font-size:.9rem}
 .hero{padding:64px 0 36px;text-align:center}
 .hero h1{font-size:3rem;font-weight:800;letter-spacing:-.02em}
 .hero h1 em{color:var(--accent);font-style:normal}
 .hero p{color:var(--muted);font-size:1.1rem;margin-top:12px}
 .hero .btn{display:inline-block;margin-top:24px}
 .grid{display:grid;grid-template-columns:repeat(3,1fr);gap:16px;padding:30px 0 70px}
 .tile{position:relative;border-radius:14px;overflow:hidden;border:1px solid var(--line);aspect-ratio:4/3;background:var(--panel)}
 .tile img{width:100%;height:100%;object-fit:cover;display:block;transition:.3s}
 .tile:hover img{transform:scale(1.05)}
 .tile .cap{position:absolute;left:12px;bottom:10px;font-weight:600;text-shadow:0 2px 8px #000}
 footer{border-top:1px solid var(--line);color:var(--muted);padding:28px 0;font-size:.88rem;text-align:center}
</style></head><body>
<header><div class="wrap nav">
  <div class="brand">Lens<span>Hub</span></div>
  <nav><a href="/">Explore</a><a href="/upload.php">Share a photo</a><a href="#">Sign in</a>
  <a class="btn" href="/upload.php">Upload</a></nav>
</div></header>

<section class="hero"><div class="wrap">
  <h1>Where photographers <em>share</em> their best work</h1>
  <p>A community gallery. Upload a shot, get seen. No sign-up required to post.</p>
  <a class="btn" href="/upload.php">Share your photo →</a>
</div></section>

<section class="wrap">
  <div class="grid">
    <?php foreach ($imgs as $f): ?>
      <div class="tile"><img src="uploads/<?php echo htmlspecialchars($f); ?>" alt="">
        <div class="cap"><?php echo htmlspecialchars(pathinfo($f, PATHINFO_FILENAME)); ?></div></div>
    <?php endforeach; ?>
  </div>
</section>

<footer><div class="wrap">LensHub Community &middot; &copy; 2026 &middot; Built for shutterbugs.</div></footer>
</body></html>
