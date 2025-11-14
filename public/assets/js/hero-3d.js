// File: public/assets/js/hero-3d.js
import * as THREE from 'three';

let scene = new THREE.Scene();
let camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
let renderer = new THREE.WebGLRenderer({ canvas: document.getElementById('heroCanvas'), alpha: true });

renderer.setSize(window.innerWidth, window.innerHeight);

let geometry = new THREE.IcosahedronGeometry(2, 1);
let material = new THREE.MeshStandardMaterial({ color: 0x00ffff, wireframe: true });
let mesh = new THREE.Mesh(geometry, material);
scene.add(mesh);

let light = new THREE.PointLight(0xffffff, 1, 100);
light.position.set(5, 5, 5);
scene.add(light);

camera.position.z = 5;

function animate() {
  requestAnimationFrame(animate);
  mesh.rotation.x += 0.005;
  mesh.rotation.y += 0.005;
  renderer.render(scene, camera);
}

animate();

window.addEventListener('resize', () => {
  camera.aspect = window.innerWidth / window.innerHeight;
  camera.updateProjectionMatrix();
  renderer.setSize(window.innerWidth, window.innerHeight);
});