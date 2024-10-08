console.clear;
console.log("ta mère");
class Character {
  constructor(hitPoints, damage) {
    this.hitPoints = hitPoints;
    this.damage = damage;
  }
}

const player1 = new Character(200, 20);
const player2 = new Character(300, 10);

while (player1.hitPoints > 0 && player2.hitPoints > 0) {
  player1.attack(player2);
  player2.attack(player1);
}
