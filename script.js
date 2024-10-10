console.clear;
console.log("Frangipute");
console.log("Carapute");
console.log("Pute");
const canvas = document.getElementById("gameCanvas");
const ctx = canvas.getContext("2d");

// Variables for the character
let zombie = {
  x: 50,
  y: canvas.height - 80, // Initial position
  width: 50,
  height: 50,
  color: "green",
  dy: 0,
  gravity: 0.5,
  jumpPower: -10,
  isJumping: false,
};

// Obstacles
let obstacles = [];
let obstacleSpeed = 5;
let spawnRate = 90; // Frames
let minDistanceForAirObstacles = 5; // 5 obstacle dodged, start générate some obstacles in sky

// Score
let score = 0;

// Game's variables
let gameSpeed = 1;
let frameCount = 0;

// Function draw
function drawZombie() {
  ctx.fillStyle = zombie.color;
  ctx.fillRect(zombie.x, zombie.y, zombie.width, zombie.height);
}

// Function create obstacle
function createObstacle() {
  let obstacleHeight = 30; // Height obstacle
  let obstacleY = canvas.height - 60; // Base position (on the ground)

  // If the score is higher than the defined threshold, aerial obstacles can be created
  if (score > minDistanceForAirObstacles) {
    let maxY = canvas.height - 150; // Max limit for the height obstacle
    obstacleY =
      Math.random() > 0.5
        ? canvas.height - 60
        : maxY + Math.random() * (canvas.height - maxY - 60);
    // 50% chance that the obstacle is high with a random position
  }

  let obstacle = {
    x: canvas.width,
    y: obstacleY,
    width: 30,
    height: obstacleHeight,
    color: "brown",
  };
  obstacles.push(obstacle);
}

// Function draw obstacles
function drawObstacles() {
  obstacles.forEach((obstacle) => {
    ctx.fillStyle = obstacle.color;
    ctx.fillRect(obstacle.x, obstacle.y, obstacle.width, obstacle.height);
  });
}

// Function update obstacle
function updateObstacles() {
  obstacles.forEach((obstacle) => {
    obstacle.x -= obstacleSpeed;

    // Check up if obstacle go out of screen
    if (obstacle.x + obstacle.width < 0) {
      obstacles.shift(); // Delete first obstacle
      score++;
    }

    // Collision with player
    if (
      zombie.x < obstacle.x + obstacle.width &&
      zombie.x + zombie.width > obstacle.x &&
      zombie.y < obstacle.y + obstacle.height &&
      zombie.y + zombie.height > obstacle.y
    ) {
      gameOver();
    }
  });
}

// Function jump
function jump() {
  if (!zombie.isJumping) {
    zombie.dy = zombie.jumpPower;
    zombie.isJumping = true;
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
  zombie.dy += zombie.gravity;
  zombie.y += zombie.dy;

  // Limit of height
  if (zombie.y > canvas.height - 80) {
    zombie.y = canvas.height - 80;
    zombie.dy = 0;
    zombie.isJumping = false;
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
// end loop
