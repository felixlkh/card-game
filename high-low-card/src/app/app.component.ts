import {Component, ElementRef} from '@angular/core';
import {HttpClient} from "@angular/common/http";

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.scss']
})

export class AppComponent {
  deck: any;
  btnStart: any;
  cardBack: any;
  firstCardEl: any;
  buttons: any;
  scoreboard: any;
  controls: any;
  controlsWrapper: any;
  deckWrapper: any;
  gameover = false;
  nextCard: any;
  firstCard: any;
  Cards = new Array;
  counter = 0;
  score = 0;
  lives = 3;
  currentCardValue = 0;
  setting: any = undefined;

  constructor(
    private elRef: ElementRef,
    private http: HttpClient
  ) {
    this.http.get('http://localhost/api/setting').subscribe((data: any) => {
      this.setting = data.data;
      this.lives = this.setting.live;
      this.updateScore();
    });
  };

  /**
   *Initialize variable
   */
  ngOnInit(): void {
    this.btnStart = document.getElementById("start");
    this.cardBack = document.getElementById("back");
    this.firstCardEl = document.getElementById("first-card");
    this.buttons = document.querySelectorAll("[data-btn-type]");
    this.scoreboard = document.getElementById("scoreboard");
    this.controls = document.getElementById("controls");
    this.controlsWrapper = document.getElementById("controls__wrapper");
    this.deckWrapper = document.getElementById("deck-wrapper");

    //Create Card Deck
    this.newDeck(() => {
      // Get first card
      this.firstCard = this.deck.next().value;
      this.currentCardValue = (this.firstCard.value);
    });
  }

  /**
   * Create Card Deck
   * @param callback
   */
  newDeck(callback: any) {
    this.http.get('/json').subscribe((data: any) => {
      data.forEach((item: { value: string; }, i: string | number) => {
        if (item.value == "A") data[i].value = "1";
      });
      data.forEach((item: { value: string; }, i: string | number) => {
        if (item.value == "jack") data[i].value = "11";
      });
      data.forEach((item: { value: string; }, i: string | number) => {
        if (item.value == "queen") data[i].value = "12";
      });
      data.forEach((item: { value: string; }, i: string | number) => {
        if (item.value == "king") data[i].value = "13";
      });

      let deck: {}[] = [];
      deck = this.shuffle(data);

      function* deckGenerator(): Generator {
        for (const card of deck) {
          yield card;
        }
      }

      // Set deck value
      this.deck = deckGenerator();
      callback();
    });
  }

  /**
   * Shuffle the Card
   * @param data
   */
  shuffle(data: any) {
    var m = data.length, t, i;
    while (m) {
      i = Math.floor(Math.random() * m--);
      t = data[m];
      data[m] = data[i];
      data[i] = t;
    }
    return data;
  }

  /**
   * Start a New Game
   */
  start() {
    this.cardBack.setAttribute("class", "card card_back card_back-hide");
    this.firstCardEl.setAttribute("class", "card card_up");
    this.btnStart.setAttribute("style", "opacity: 0");
    this.controlsWrapper.setAttribute("style", "visibility: visible");

    // When first card transition ends
    this.firstCardEl.addEventListener("transitionend", this.firstCardEvent());

  }

  /**
   * Handle the First Card when we start the game
   */
  firstCardEvent() {
    this.controlsWrapper.setAttribute("style", `${this.controlsWrapper.getAttribute("style")}; opacity: 1;`);
    this.scoreboard.setAttribute("style", "opacity: 1;");
    this.firstCardEl.removeEventListener("transitionend", this.firstCardEvent);
    this.cardBack.parentNode.removeChild(this.cardBack);
  }

  /**
   * Guess Checking
   * @param e
   */
  guessChecking(e: any) {
    const buttons: Element[] = Array.from(document.querySelectorAll("[data-btn-type]"));
    buttons.forEach((button: Element) => {
      button.setAttribute("disabled", "disabled");
    });

    this.counter = this.counter + 1;

    this.nextCard = this.deck.next().value;
    const btnPressed: string = e.target.dataset.btnType;


    if (btnPressed === "+") {
      (Number(this.nextCard.value) >= this.currentCardValue) ? this.addScore() : this.reduceLives();
    } else {
      (Number(this.nextCard.value) <= this.currentCardValue) ? this.addScore() : this.reduceLives();
    }

    this.Cards.push(this.nextCard);
    this.currentCardValue = (this.nextCard.value);

    this.updateScore();

    if (!this.lives || this.counter === 51) {
      this.gameOver();
    } else {
      this.buttonChecking(this.nextCard.value);
    }
  }

  /**
   * Check Higher,Lower button
   * @param nextCardValue
   */
  buttonChecking(nextCardValue: number): void {
    const [btnHigher, btnLower]: any = [document.querySelector("[data-btn-type='+']"), document.querySelector("[data-btn-type='-']")];

    if (nextCardValue === 2) {
      btnLower.setAttribute("disabled", "disabled");
      btnLower.setAttribute("data-disabled", "1");
    } else {
      btnLower.removeAttribute("disabled");
      btnLower.removeAttribute("data-disabled");
    }

    // Card value is ace, then disable higher button
    if (nextCardValue === 14) {
      btnHigher.setAttribute("disabled", "disabled");
      btnHigher.setAttribute("data-disabled", "1");
    } else {
      btnHigher.removeAttribute("disabled");
      btnHigher.removeAttribute("data-disabled");
    }
  }

  /**
   * Update the Score
   */
  updateScore() {
    // Cache selectors
    const [score, lives]: any = [document.getElementById("score"), document.getElementById("lives")];

    // Animate scoreboard data change
    this.animateScore(score, score.textContent, this.score || 0);
    this.animateScore(lives, lives.textContent, this.lives || 3);

    // Update DOM
    score.textContent = this.score.toString();
    lives.textContent = this.lives.toString();
  }


  /**
   * Handle score animation
   * @param el
   * @param prev
   * @param next
   */
  animateScore(el: Element, prev: string, next: number): void {
    if (prev !== next.toString()) {
      const className: string = "scoreboard__item_changed";

      // Add animation class
      el.classList.add(className);

      el.addEventListener("animationend", () => {
        // Once animation is over, remove animation class
        el.classList.remove(className);
      });
    }
  }

  /**
   * End of the Game
   */
  gameOver(): void {
    // Hide scoreboard and game controls
    this.scoreboard.setAttribute("style", "opacity: 0; transition-delay: 500ms");
    this.controls.setAttribute("style", "opacity: 0; visibility: visible");

    // Pick up deck
    this.deckWrapper.setAttribute("class", `${this.deckWrapper.getAttribute("class")} deck-wrapper_up`);
    this.deckWrapper.setAttribute("style", "will-change: transition, opacity; transition-delay: 1000ms");

    setTimeout(() => {
      this.gameover = true;
      this.deckWrapper.removeAttribute("style");

      // Remove additional class added to fire transitions
      this.deckWrapper.setAttribute("class", "deck-wrapper");

      this.firstCard = {};
      this.Cards = new Array();
    }, 1200);
  }

  /**
   * Restart the Game
   */
  restart(): void {
    const buttons: Element[] = Array.from(document.querySelectorAll("[data-btn-type]"));

    buttons.forEach((button: Element) => { // Convert to array as you can't use a ForEach loop on a nodelist in Edge
      button.removeAttribute("disabled");
    });

    this.counter = 0;
    this.score = 0;
    this.lives = this.setting==undefined?3:this.setting.live;
    this.currentCardValue = 0;

    this.updateScore();

    //Create Card Deck
    this.newDeck(() => {
      this.firstCard = this.deck.next().value;
      this.buttonChecking(this.firstCard.value);

      this.currentCardValue = (this.firstCard.value);
      this.gameover = false;
      this.scoreboard.setAttribute("style", "opacity: 1; transition-delay: 600ms");
      this.controls.setAttribute("style", "opacity: 1; visibility: visible;  transition-delay: 600ms");
    });
  }


  /**
   * add score
   */
  addScore(): void {
    this.score = this.score + 1;
  }

  /**
   * Reduce Lives
   */
  reduceLives(): void {
    this.lives = this.lives - 1;
  }


}
