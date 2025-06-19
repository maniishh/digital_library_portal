const canvas = document.getElementById('canvas-bg');
const ctx = canvas.getContext('2d');

let particlesArray;
const maxRadius = 2;
const connectDistance = 100;

canvas.width = window.innerWidth;
canvas.height = window.innerHeight;

window.addEventListener('resize', function () {
  canvas.width = window.innerWidth;
  canvas.height = window.innerHeight;
  init();
});

class Particle {
  constructor() {
    this.x = Math.random() * canvas.width;
    this.y = Math.random() * canvas.height;
    this.directionX = (Math.random() - 0.5) * 0.8;
    this.directionY = (Math.random() - 0.5) * 0.8;
    this.radius = maxRadius;
  }

  draw() {
    ctx.beginPath();
    ctx.arc(this.x, this.y, this.radius, 0, Math.PI * 2, false);
    ctx.fillStyle = 'rgba(255, 255, 255, 0.7)';
    ctx.fill();
  }

  update() {
    if (this.x > canvas.width || this.x < 0) this.directionX *= -1;
    if (this.y > canvas.height || this.y < 0) this.directionY *= -1;

    this.x += this.directionX;
    this.y += this.directionY;
    this.draw();
  }
}

function init() {
  particlesArray = [];
  const numParticles = (canvas.width * canvas.height) / 8000;
  for (let i = 0; i < numParticles; i++) {
    particlesArray.push(new Particle());
  }
}

function connect() {
  for (let a = 0; a < particlesArray.length; a++) {
    for (let b = a + 1; b < particlesArray.length; b++) {
      let dx = particlesArray[a].x - particlesArray[b].x;
      let dy = particlesArray[a].y - particlesArray[b].y;
      let distance = Math.sqrt(dx * dx + dy * dy);

      if (distance < connectDistance) {
        ctx.beginPath();
        ctx.strokeStyle = 'rgba(255,255,255,0.1)';
        ctx.lineWidth = 1;
        ctx.moveTo(particlesArray[a].x, particlesArray[a].y);
        ctx.lineTo(particlesArray[b].x, particlesArray[b].y);
        ctx.stroke();
      }
    }
  }
}

function animate() {
  requestAnimationFrame(animate);
  ctx.clearRect(0, 0, canvas.width, canvas.height);

  particlesArray.forEach(p => p.update());
  connect();
}

init();
animate();
