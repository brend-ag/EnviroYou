var resultOrg = 0;
var cityOrg = 0;
(function(){
  // Functions
  function buildQuiz(){
    // variable to store the HTML output
    const output = [];

    // for each question...
    myQuestions.forEach(
      (currentQuestion, questionNumber) => {

        // variable to store the list of possible answers
        const answers = [];

        // and for each available answer...
        for(letter in currentQuestion.answers){

          // ...add an HTML radio button
          answers.push(
            `<label>
              <input type="radio" name="question${questionNumber}" value="${letter}">
              ${letter} :
              ${currentQuestion.answers[letter]}
            </label>`
          );
        }

        // add this question and its answers to the output
        //creates divs for each slide, Q, answer (thus answer containers)
        output.push(
          `<div class="slide">
            <div class="question"> ${currentQuestion.question} </div>
            <div class="answers"> ${answers.join("")} </div>
          </div>`
        );
      }
    );

    // finally combine our output list into one string of HTML and put it on the page
    quizContainer.innerHTML = output.join('');
  }

  function showResults(){

    // gather answer containers from our quiz
    const answerContainers = quizContainer.querySelectorAll('.answers');

    // keep track of user's answers, each variable corresponds with the different result options
    let community = 0;
    let food = 0;
    let education = 0;
    let farming = 0;
    let ny = 0;
    let noho = 0;
    let la = 0;

    //Text variables for the text that appears at the end of the survey
    let nyText = `and is located in or near New York.`;
    let laText = `and is located in or near Los Angeles.`;
    let nohoText = `and is located in or near Northampton.`;

    let foodText = `food equity `;
    let educationText = `education `;
    let farmingText = `farming and gardening `;
    let communityText = `community building `;

    // for each question...
    myQuestions.forEach( (currentQuestion, questionNumber) => {

      // find selected answer
      const answerContainer = answerContainers[questionNumber];
      const selector = `input[name=question${questionNumber}]:checked`;
      const userAnswer = (answerContainer.querySelector(selector) || {}).value;

      /*Adds to the respective variables depending on the user's answer
      Colors different colors depending on the answers:
          - food: pink, #ED217C
          - education: dark teal, #1B998B
          - community: light purple, #D9B3CC
          - farming: light blue, #FF9B71
      */
      if(userAnswer == currentQuestion.nyAnswer){
        ny++;
      }
      if(userAnswer == currentQuestion.nohoAnswer){
        noho++;
      }
      if(userAnswer == currentQuestion.laAnswer){
        la++;
      }

      if(userAnswer == currentQuestion.foodAnswer){
        food++;
        answerContainers[questionNumber].style.color = '#ED217C';
      }

      if(userAnswer == currentQuestion.educationAnswer){
        education++;
        answerContainers[questionNumber].style.color = '#1B998B';
      }

      if(userAnswer === currentQuestion.communityAnswer){
        community++;
        answerContainers[questionNumber].style.color = '#D9B3CC';
      }

      if(userAnswer == currentQuestion.farmingAnswer){
        farming++;
        answerContainers[questionNumber].style.color = '#FF9B71';
      }
      // if answer is wrong or blank
      else{
    //    answerContainers[questionNumber].style.color = '#FF9B71';
        resultsContainer.innerHTML =  `Too many answers were left blank or the results were inconclusive.`+ ` Please take the quiz again.`;

      }
    });

    // show number of correct answers out of total

    /*********
    Code below displays the amount of answers that correspond to each variable
    Answer routes: Food = "a"; education: "b"; community: "c"; farming:"d"
    City routes (first question): New York = "a"; Northampton: "b"; Los Angeles: "c"
    resultOrg signifies the type of organization: 1 = food, 2 = education, 3 = community, 4 = farming
    cityOrg represents the city of the organization: 1 = NY, 2 = Noho, 3 = LA

    *********/

    //Food choice and city combinations
    if((food >= 2)&&(ny==1)){
       resultsContainer.innerHTML =  `Based on your results, we found that you need an organization that focuses on `+ foodText + nyText;
       resultOrg = 1;
       cityOrg = 1;
    }
    if((food >= 2)&&(noho==1)){
       resultsContainer.innerHTML =  `Based on your results, we found that you need an organization that focuses on `+ foodText + nohoText;
       resultOrg = 1;
       cityOrg = 2;
    }

    if((food >= 2)&&(la==1)){
       resultsContainer.innerHTML =  `Based on your results, we found that you need an organization that focuses on `+ foodText + laText;
       resultOrg = 1;
       cityOrg = 3;
    }
    //Education choice and city combinations
    if((education >= 2)&&(ny==1)){
       resultsContainer.innerHTML =  `Based on your results, we found that you need an organization that focuses on `+ educationText + nyText;
       resultOrg = 2;
       cityOrg = 1;
    }
    if((education >= 2)&&(noho==1)){
       resultsContainer.innerHTML =  `Based on your results, we found that you need an organization that focuses on `+ educationText + nohoText;
       resultOrg = 2;
       cityOrg = 2;
    }

    if((education >= 2)&&(la==1)){
       resultsContainer.innerHTML =  `Based on your results, we found that you need an organization that focuses on `+ educationText + laText;
       resultOrg = 2;
       cityOrg = 3;
    }

    //Community choice and city combinations
    if((community >= 2)&&(ny==1)){
       resultsContainer.innerHTML =  `Based on your results, we found that you need an organization that focuses on `+ communityText + nyText;
       resultOrg = 3;
       cityOrg = 1;
    }
    if((community >= 2)&&(noho==1)){
       resultsContainer.innerHTML =  `Based on your results, we found that you need an organization that focuses on `+ communityText + nohoText;
       resultOrg = 3;
       cityOrg = 2;
    }

    if((community >= 2)&&(la==1)){
       resultsContainer.innerHTML =  `Based on your results, we found that you need an organization that focuses on `+ communityText + laText;
       resultOrg = 3;
       cityOrg = 3;
    }

    //Farming choice and city combinations
    if((farming >= 2)&&(ny==1)){
       resultsContainer.innerHTML =  `Based on your results, we found that you need an organization that focuses on `+ farmingText + nyText;
       resultOrg = 4;
       cityOrg = 1;
    }
    if((farming >= 2)&&(noho==1)){
       resultsContainer.innerHTML =  `Based on your results, we found that you need an organization that focuses on `+ farmingText + nohoText;
       resultOrg = 4;
       cityOrg = 2;
    }

    if((farming >= 2)&&(la==1)){
       resultsContainer.innerHTML =  `Based on your results, we found that you need an organization that focuses on `+ farmingText + laText;
       resultOrg = 4;
       cityOrg = 3;
    }

    return resultOrg, cityOrg;
  }

  function showSlide(n) {
    slides[currentSlide].classList.remove('active-slide');
    slides[n].classList.add('active-slide');
    currentSlide = n;
    if(currentSlide === 0){
      previousButton.style.display = 'none';
    }
    else{
      previousButton.style.display = 'inline-block';
    }
    if(currentSlide === slides.length-1){
      nextButton.style.display = 'none';
      submitButton.style.display = 'inline-block';
    }
    else{
      nextButton.style.display = 'inline-block';
      submitButton.style.display = 'none';
    }
  }

  function showNextSlide() {
    showSlide(currentSlide + 1);
  }

  function showPreviousSlide() {
    showSlide(currentSlide - 1);
  }

  // Variables
  const quizContainer = document.getElementById('quiz');
  const resultsContainer = document.getElementById('results');
  const submitButton = document.getElementById('submit');
  const myQuestions = [
    {
      question: "Where are you located?",
      answers: {
        a: "New York, NY",
        b: "Northampton, MA",
        c: "Los Angeles, CA",
      },
      foodAnswer: "",
      communityAnswer:"",
      communityAnswer: "",
      farmingAnswer:"",
      nyAnswer: "a",
      nohoAnswer: "b",
      laAnswer: "c"
    },
    {
      question: "What problem do you see around you that you wish you could do something about?",
      answers: {
        a: "Food instability",
        b: "Lack of education on environmental issues",
        c: "Disconnect within community members",
        d: "Increasing lack of connection from people and the land"
      },
      foodAnswer: "a",
      educationAnswer:"b",
      communityAnswer: "c",
      farmingAnswer: "d",
      nyAnswer: "",
      nohoAnswer: "",
      laAnswer: ""
    },
    {
      question: "Which possible solution to the previous problem interests you?",
      answers: {
        a: "Food sovereignty",
        b: "Education and outreach",
        c: "Community building",
        d: "Accessible farming/gardening"
      },
      foodAnswer: "a",
      educationAnswer:"b",
      communityAnswer: "c",
      farmingAnswer: "d",
      nyAnswer: "",
      nohoAnswer: "",
      laAnswer: ""
    },
    {
      question: "Which activity do you or would you enjoy doing the most?",
      answers: {
        a: "Eating new foods",
        b: "Learning and passing on knowledge",
        c: "Meeting new people",
        d: "Taking care of plants"
      },
      foodAnswer: "a",
      educationAnswer:"b",
      communityAnswer: "c",
      farmingAnswer: "d",
      nyAnswer: "",
      nohoAnswer: "",
      laAnswer: ""
    }
  ];

  // Build and start Quiz
  buildQuiz();

  // Pagination between each question
  const previousButton = document.getElementById("previous");
  const nextButton = document.getElementById("next");
  const slides = document.querySelectorAll(".slide");
  let currentSlide = 0;


  // Show the first slide
  showSlide(currentSlide);

  // Event listeners
  submitButton.addEventListener('click', showResults);
  previousButton.addEventListener("click", showPreviousSlide);
  nextButton.addEventListener("click", showNextSlide);


})();
