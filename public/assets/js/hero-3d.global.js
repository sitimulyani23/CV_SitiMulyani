// File: public/assets/js/hero-3d.global.js
(function () {
  const canvas = document.getElementById('heroCanvas');
  if (!canvas || !window.THREE) return;

  const scene = new THREE.Scene();
  const camera = new THREE.PerspectiveCamera(
    75,
    window.innerWidth / window.innerHeight,
    0.1,
    1000
  );

  const renderer = new THREE.WebGLRenderer({ canvas, alpha: true, antialias: true });
  renderer.setPixelRatio(window.devicePixelRatio || 1);
  renderer.setSize(window.innerWidth, window.innerHeight);

  // “Komputer” sederhana: kotak + layar + wireframe
  const group = new THREE.Group();

  // Body komputer
  const bodyGeo = new THREE.BoxGeometry(3.2, 2.2, 0.3);
  const bodyMat = new THREE.MeshStandardMaterial({ color: 0x111111, metalness: 0.3, roughness: 0.6 });
  const body = new THREE.Mesh(bodyGeo, bodyMat);
  group.add(body);

  // Layar (sedikit timbul)
  const screenGeo = new THREE.PlaneGeometry(2.8, 1.6);
  const screenMat = new THREE.MeshStandardMaterial({ color: 0x00ffff, emissive: 0x003344, emissiveIntensity: 0.6 });
  const screen = new THREE.Mesh(screenGeo, screenMat);
  screen.position.z = 0.16;
  group.add(screen);

  // Wireframe efek tech
  const wire = new THREE.WireframeGeometry(new THREE.IcosahedronGeometry(1.6, 2));
  const line = new THREE.LineSegments(wire, new THREE.LineBasicMaterial({ color: 0x00ffff, transparent: true, opacity: 0.45 }));
  line.position.z = -0.5;
  group.add(line);

  scene.add(group);

  // Pencahayaan
  const light = new THREE.PointLight(0xffffff, 1.2);
  light.position.set(5, 5, 5);
  scene.add(light);

  const rim = new THREE.DirectionalLight(0x00ffff, 0.6);
  rim.position.set(-3, 2, -2);
  scene.add(rim);

  camera.position.z = 6;

  // Parallax mengikuti kursor
  let targetRotX = 0, targetRotY = 0;
  window.addEventListener('mousemove', (e) => {
    const nx = (e.clientX / window.innerWidth) * 2 - 1;   // -1..1
    const ny = (e.clientY / window.innerHeight) * 2 - 1;  // -1..1
    targetRotY = nx * 0.35;
    targetRotX = -ny * 0.25;
  });

  // Resize handler
  function onResize() {
    camera.aspect = window.innerWidth / window.innerHeight;
    camera.updateProjectionMatrix();
    renderer.setSize(window.innerWidth, window.innerHeight);
  }
  window.addEventListener('resize', onResize);

  // Animasi
  function animate() {
    requestAnimationFrame(animate);
    // easing rotasi
    group.rotation.x += (targetRotX - group.rotation.x) * 0.08;
    group.rotation.y += (targetRotY - group.rotation.y) * 0.08;

    // sedikit gerak wireframe
    line.rotation.y += 0.005;
    renderer.render(scene, camera);
  }
  animate();
})();
