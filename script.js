let canvas = document.getElementById('gameCanvas');
let context = canvas.getContext('2d');
let scoreElement = document.getElementById('scoreValue');

const grid = 20;
let count = 0;
let score = 0;
let paused = false;

let snake = {
    x: grid * 5,
    y: grid * 5,
    cells: [],
    maxCells: 4,
    dx: grid,
    dy: 0
};

let apple = {
    x: grid * 10,
    y: grid * 10
};

function getRandomInt(min, max) {
    return Math.floor(Math.random() * (max - min)) + min;
}

function resetGame() {
    snake.x = grid * 5;
    snake.y = grid * 5;
    snake.cells = [];
    snake.maxCells = 4;
    snake.dx = grid;
    snake.dy = 0;
    apple.x = getRandomInt(0, 20) * grid;
    apple.y = getRandomInt(0, 20) * grid;
    score = 0;
    scoreElement.innerText = score;
}

function gameLoop() {
    if (paused) {
        return;
    }

    requestAnimationFrame(gameLoop);

    if (++count < 4) {
        return;
    }

    count = 0;
    context.clearRect(0, 0, canvas.width, canvas.height);

    snake.x += snake.dx;
    snake.y += snake.dy;

    if (snake.x < 0) {
        snake.x = canvas.width - grid;
    } else if (snake.x >= canvas.width) {
        snake.x = 0;
    }

    if (snake.y < 0) {
        snake.y = canvas.height - grid;
    } else if (snake.y >= canvas.height) {
        snake.y = 0;
    }

    snake.cells.unshift({ x: snake.x, y: snake.y });

    if (snake.cells.length > snake.maxCells) {
        snake.cells.pop();
    }

    context.fillStyle = 'red';
    context.fillRect(apple.x, apple.y, grid - 1, grid - 1);

    context.fillStyle = 'green';
    snake.cells.forEach(function (cell, index) {
        context.fillRect(cell.x, cell.y, grid - 1, grid - 1);

        if (cell.x === apple.x && cell.y === apple.y) {
            snake.maxCells++;
            score += 10;
            scoreElement.innerText = score;
            apple.x = getRandomInt(0, 20) * grid;
            apple.y = getRandomInt(0, 20) * grid;
        }

        for (let i = index + 1; i < snake.cells.length; i++) {
            if (cell.x === snake.cells[i].x && cell.y === snake.cells[i].y) {
                resetGame();
            }
        }
    });
}

document.addEventListener('keydown', function (e) {
    if (e.key === 'ArrowLeft' && snake.dx === 0) {
        snake.dx = -grid;
        snake.dy = 0;
    } else if (e.key === 'ArrowUp' && snake.dy === 0) {
        snake.dy = -grid;
        snake.dx = 0;
    } else if (e.key === 'ArrowRight' && snake.dx === 0) {
        snake.dx = grid;
        snake.dy = 0;
    } else if (e.key === 'ArrowDown' && snake.dy === 0) {
        snake.dy = grid;
        snake.dx = 0;
    } else if (e.key === 'p' || e.key === 'P') {
        paused = !paused;
        if (!paused) {
            requestAnimationFrame(gameLoop);
        }
    } else if (e.key === 'Enter') {
        resetGame();
    }
});

// Touch controls
document.getElementById('leftBtn').addEventListener('click', function() {
    if (snake.dx === 0) {
        snake.dx = -grid;
        snake.dy = 0;
    }
});

document.getElementById('upBtn').addEventListener('click', function() {
    if (snake.dy === 0) {
        snake.dy = -grid;
        snake.dx = 0;
    }
});

document.getElementById('downBtn').addEventListener('click', function() {
    if (snake.dy === 0) {
        snake.dy = grid;
        snake.dx = 0;
    }
});

document.getElementById('rightBtn').addEventListener('click', function() {
    if (snake.dx === 0) {
        snake.dx = grid;
        snake.dy = 0;
    }
});

resetGame();
requestAnimationFrame(gameLoop);
