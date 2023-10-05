let clock = document.querySelector('#clock');
let time= 10
let timelimit = 0


function timecal(){

clock.textContent =time;

if(time <= timelimit){
    clearInterval(timer);
}else{
   return time--
}
}

let timer=setInterval(timecal,1000)