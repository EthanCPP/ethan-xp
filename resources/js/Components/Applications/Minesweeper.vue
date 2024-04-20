<script setup>
import { onMounted, ref } from 'vue';
import Icons from '../../Util/Icons';
import Application from '../Application.vue';
import mine from '@/../image/mine.png';
import flag from '@/../image/flag.png';
import sad from '@/../image/minesweeper-sad.png';
import happy from '@/../image/minesweeper-happy.png';

const stage = ref(null);
var cols = []; // [Y][X]
var mines = [];

var alive = true;

var counterMine = ref('000');
var counterTime = ref('000');

var timeElapsed = 0;
var minesRemaining = 0;

var gameStarted = false;
var won = false;

const emit = defineEmits(['startApplication']);

onMounted(() => {
    init();

    // TEMPORARY
    // document.addEventListener('contextmenu', (e) => {
    //     e.preventDefault();
    // });
});

function init() {
    // Janky unpack system. This can surely be improved.
    stage.value.querySelectorAll('.minesweeper__row').forEach((row, i) => {
        var r = [];

        row.querySelectorAll('.minesweeper__col').forEach((col, j) => {
            r.push(col);
        });

        cols.push(r);
    });

    placeMines();
    setAnswers();
    updateMines();
}

var gameInterval = null;

function startGame() {
    gameStarted = true;

    gameInterval = setInterval(() => {
        if (timeElapsed < 999 && alive && ! won) {
            timeElapsed++;
            counterTime.value = String(timeElapsed).padStart(3, '0');
        } else {
            clearInterval(gameInterval);
        }
    }, 1000);
}

function updateMines() {
    counterMine.value = String(minesRemaining).padStart(3, '0');
}

function placeMines(count = 10) {
    minesRemaining = count;

    while (count > 0) {
        var isFree = false;

        while (! isFree) {
            const mineX = Math.ceil(Math.random() * 9) - 1;
            const mineY = Math.ceil(Math.random() * 9) - 1;

            const minesStringed = JSON.stringify([mineX, mineY]);

            isFree = ! mines.some(el => JSON.stringify(el) === minesStringed);

            if (isFree) {
                mines.push([mineX, mineY]);
            }
        }

        count--;
    }
    
    mines.forEach((mine) => {
        cols[mine[1]][mine[0]].classList.add('mine');
    });
}

function getAllNeighbours(x, y) {
    const neighbours = [
        cols[y - 1] ? cols[y - 1][x - 1] : undefined, // top left
        cols[y - 1] ? cols[y - 1][x] : undefined,     // top
        cols[y - 1] ? cols[y - 1][x + 1] : undefined, // top right
        cols[y][x - 1],                               // left
        cols[y][x + 1],                               // right
        cols[y + 1] ? cols[y + 1][x - 1] : undefined, // bottom left
        cols[y + 1] ? cols[y + 1][x] : undefined,     // bottom
        cols[y + 1] ? cols[y + 1][x + 1] : undefined, // bottom right
    ];

    return neighbours;
}

function setAnswers() {
    cols.forEach((r, i) => {
        r.forEach((c, j) => {
            if (c.classList.contains('mine')) {
                return;
            }

            var mineCount = 0; // number of neighbouring mines

            const neighbours = getAllNeighbours(j, i);

            neighbours.forEach((neighbour) => {
                if (neighbour === undefined) {
                    return;
                }

                if (neighbour.classList.contains('mine')) {
                    mineCount++;
                }
            });

            if (mineCount > 0) {
                c.querySelector('.minesweeper__answer').classList.add('mines-' + mineCount);
                c.querySelector('.minesweeper__answer').innerHTML = mineCount;
            }

            c.dataset.neighbours = mineCount;
        });
    });
}

function toggleFlag(i) {
    if (! alive) {
        return;
    }

    if (! gameStarted) {
        startGame();
    }

    const hasFlag = i.target.parentElement.classList.contains('flag');

    if (hasFlag) {
        i.target.parentElement.classList.remove('flag');
        minesRemaining++;
        updateMines();
    } else {
        if (minesRemaining > 0) {
            i.target.parentElement.classList.add('flag');
            minesRemaining--;
            updateMines();
        }
    }
}

function reveal(button) {
    if (button.parentElement.classList.contains('revealed')) {
        return;
    }

    button.parentElement.classList.add('revealed');

    if (button.parentElement.classList.contains('mine')) {
        button.parentElement.classList.add('dead');
        alive = false;
    } else {
        if (button.parentElement.dataset.neighbours == 0) {
            // auto reveal any neighbours as long as they are not a mine
            const neighbours = getAllNeighbours(parseInt(button.dataset.x), parseInt(button.dataset.y));

            neighbours.forEach((neighbour) => {
                if (neighbour === undefined) {
                    return;
                }

                if (neighbour.classList.contains('mine') || neighbour.classList.contains('flag')) {
                    return;
                }

                reveal(neighbour.querySelector('.minesweeper__button'));
            });
        }
    }
}

function clickButton(i) {
    if (! alive) {
        return;
    }

    if (! gameStarted) {
        startGame();
    }

    if (i.target.parentElement.classList.contains('flag')) {
        return;
    }

    reveal(i.target);

    var allDone = true;
    cols.forEach((r) => {
        r.forEach((c) => {
            if (! c.classList.contains('revealed') && ! c.classList.contains('mine')) {
                allDone = false;
            }
        })
    })

    if (allDone && alive) {
        won = true;
        emit('startApplication', 'success', '', {other: 'You win'});
    }
}

function restart() {
    cols.forEach((r) => {
        r.forEach((c) => {
            c.classList.remove('mine');
            c.classList.remove('revealed');
            c.classList.remove('dead');
            c.classList.remove('flag');

            c.querySelector('.minesweeper__answer').classList.remove('mines-1');
            c.querySelector('.minesweeper__answer').classList.remove('mines-2');
            c.querySelector('.minesweeper__answer').classList.remove('mines-3');
            c.querySelector('.minesweeper__answer').classList.remove('mines-4');
            c.querySelector('.minesweeper__answer').classList.remove('mines-5');
            c.querySelector('.minesweeper__answer').classList.remove('mines-6');
            c.querySelector('.minesweeper__answer').classList.remove('mines-7');
            c.querySelector('.minesweeper__answer').classList.remove('mines-8');
            c.querySelector('.minesweeper__answer').innerHTML = '';
        });
    })

    alive = true;
    won = false;
    cols = [];
    mines = [];
    timeElapsed = 0;
    minesRemaining = 0;
    gameStarted = false;

    clearInterval(gameInterval);

    updateMines();
    counterTime.value = '000';

    init();
}
</script>

<template>
    <Application :icon="Icons.minesweeper" title="Mineswe..." max-disabled="true" fit-content="true">
        <div class="minesweeper">
            <div class="minesweeper__scorebar">
                <div class="minesweeper__counter" v-html="counterMine"></div>
                <button type="button" class="btn minesweeper__restart" @click="restart()">
                    <img :src="happy" class="minesweeper__happy" v-if="alive" />
                    <img :src="sad" class="minesweeper__sad" v-if="! alive" />
                </button>
                <div class="minesweeper__counter" v-html="counterTime"></div>
            </div>

            <div class="minesweeper__stage" ref="stage">
                <div v-for="i in 9" class="minesweeper__row">
                    <div v-for="j in 9" class="minesweeper__col">
                        <div class="minesweeper__answer"></div>
                        <img :src="mine" class="minesweeper__mine" />
                        <img :src="flag" class="minesweeper__flag" />
                        <button 
                            type="button" 
                            class="btn minesweeper__button" 
                            :data-x="j - 1"
                            :data-y="i - 1"
                            @click="clickButton"
                            @contextmenu.prevent="toggleFlag"></button>
                    </div>
                </div>
            </div>
        </div>
    </Application>
</template>