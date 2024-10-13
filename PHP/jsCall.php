<script>
console.clear;
const canvas = document.getElementById("gameCanvas");
const ctx = canvas.getContext("2d");

const zombieImage = new Image();
zombieImage.src = "../img/Player.png"; // Change by the way of the image of player
const playerStats = {
  jumpPower: -20,
  isJumping: false,
  gravity: 0.5,
  dy: 0,
  x: 0,
  y: canvas.height - 100,
};

const obstacleImages = [
  "../img/obstacle1.png", // obstacle 1
  "../img/obstacle2.png", // obstacle 2
  "../img/obstacle3.png", // obstacle 3
].map((src) => {
  const img = new Image();
  img.src = src;
  return img;
});

// Obstacles
let obstacles = [];
let obstacleSpeed = 5;
let spawnRate = 90; // Frames
let minDistanceForAirObstacles = 5; // 5 obstacle dodged, start générate some obstacles in sky

// Distance for the background change
let distanceForBackgroundChange = 100;
let backgroundChanged = false;

// Score
let score = 0;

// Game's variables
let gameSpeed = 1;
let frameCount = 0;
const gravity = 0.5;
console.log(zombieImage);

// Function draw
function drawZombie() {
  // ctx.fillStyle = zombieImage.color;
  // ctx.fillRect(zombieImage.x, zombieImage.y, zombieImage.width, zombieImage.height);
  ctx.drawImage(
    zombieImage,
    playerStats.x,
    playerStats.y,
    zombieImage.width,
    zombieImage.height
  );
}

// Function create obstacle
function createObstacle() {
  const randomImageIndex = Math.floor(Math.random() * obstacleImages.length);
  const obstacleImage = obstacleImages[randomImageIndex];

  // Attendre que l'image soit chargée avant de définir la taille
  const scaleFactor = 1.5; // Ajuster ce facteur pour agrandir les obstacles
  const obstacleWidth = obstacleImage.width * scaleFactor;
  const obstacleHeight = obstacleImage.height * scaleFactor;
  let obstacleY = canvas.height - obstacleHeight - 10;

  // Génération d'obstacles aériens si le score est élevé
  if (score > minDistanceForAirObstacles) {
    const maxY = canvas.height - 150;
    obstacleY =
      Math.random() > 0.5
        ? canvas.height - obstacleHeight - 10
        : maxY + Math.random() * (canvas.height - maxY - obstacleHeight - 10);
  }

  const obstacle = {
    x: canvas.width,
    y: obstacleY,
    width: obstacleWidth,
    height: obstacleHeight,
    image: obstacleImage,
  };

  console.log("Obstacle created:", obstacle);
  obstacles.push(obstacle);
}

// Function draw obstacles
function drawObstacles() {
  obstacles.forEach((obstacle) => {
    ctx.drawImage(
      obstacle.image,
      obstacle.x,
      obstacle.y,
      obstacle.width,
      obstacle.height
    );
  });
}

// Function update obstacle
function updateObstacles() {
  obstacles.forEach((obstacle, index) => {
    obstacle.x -= obstacleSpeed;

    if (obstacle.x + obstacle.width < 0) {
      obstacles.splice(index, 1);
      score++;
      console.log("Obstacle passed, new score:", score);
    }

    // Detect collision with obstacles
    if (
      playerStats.x < obstacle.x + obstacle.width &&
      playerStats.x + playerStats.width > obstacle.x &&
      playerStats.y < obstacle.y + obstacle.height &&
      playerStats.y + playerStats.height > obstacle.y
    ) {
      console.log("Collision detected with:", obstacle);
      gameOver();
    }
  });
}

// Function jump
function jump() {
  if (!playerStats.isJumping) {
    playerStats.dy = playerStats.jumpPower;
    playerStats.isJumping = true;
  }
}

// touch for jump ("space")
document.addEventListener("keydown", function (e) {
  if (e.code === "Space") {
    jump();
  }
});

// Function for updating game
function update() {
  // Gravity
  playerStats.dy += gravity;
  // console.log(playerStats.x);

  playerStats.y += playerStats.dy;
  // console.log(playerStats.y);

  // Limit of height
  if (playerStats.y > canvas.height - 200) {
    playerStats.y = canvas.height - 200;
    playerStats.dy = 0;
    playerStats.isJumping = false;
  }

  // Add somes obstacle with regular interval
  if (frameCount % spawnRate === 0) {
    createObstacle();
  }

  // Update of obstacle
  updateObstacles();

  // Increase the difficulty with time
  if (frameCount % 500 === 0) {
    obstacleSpeed += 0.5;
  }

  // Change the background after a certain score
  if (score >= distanceForBackgroundChange && !backgroundChanged) {
    canvas.style.backgroundImage = "url('')";
    backgroundChanged = true; // change once
  }

  frameCount++;
}

// Function for draw the score
function drawScore() {
  ctx.fillStyle = "black";
  ctx.font = "20px Arial";
  ctx.fillText("Score: " + score, 20, 30);
}

// Function for manage the endgame

function gameOver() {
  alert("Game Over! Final score: " + score);
  document.location.reload();
}

// Main loop of game
function gameLoop() {
  ctx.clearRect(0, 0, canvas.width, canvas.height); // Delete canva
  drawZombie();
  drawObstacles();
  drawScore();
  update();

  requestAnimationFrame(gameLoop);
}

// Start game loop
gameLoop();

</script>