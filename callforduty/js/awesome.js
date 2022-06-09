"use strict";

let viewer = document.getElementById("annonseviewer");

let word = ['a', 'w', 'e', 's', 'o', 'm', 'e'];
let counter = 0;
let hue = 0;

document.onkeydown = function(e)
{
    if(word[counter] == e.key)
    {
        counter++;
    }
    else
    {
        counter = 0;
    }

    if(counter == word.length)
    {
        rainbow();
    }
}

function rainbow()
{
    viewer.style.backgroundColor = "hsl(" + hue + ", 100%, 50%)";

    hue++;

    requestAnimationFrame(rainbow);
}
