const quotes = [];
quotes[0] = "Every file is a new beginning.🤍";
quotes[1] = "One upload can start a revolution.";
quotes[2] = "Great things often start with a single file.";
quotes[3] = "Your next chapter is just one file away.✨";
quotes[4] = "Ideas live in every uploaded byte.";
quotes[5] = "A simple file can spark a big change.";
quotes[6] = "Behind every file, there's a story.🖤";
quotes[7] = "Upload. Share. Inspire.";
quotes[8] = "Small files, big impact.💞";
quotes[9] = "Let your uploads speak.";
quotes[10] = "Create. Upload. Begin again.💦";
quotes[11] = "A new file, a new opportunity.";
quotes[12] = "Start small, think big.💜";
quotes[13] = "From bytes to brilliance.";
quotes[14] = "Every upload is a step forward.🤎";

const quote = Math.floor(Math.random() * quotes.length);
const p = document.getElementById('pFot');
const p1 = document.getElementById('quote');

p.innerHTML = quotes[quote];
setInterval(() => {
    const q = Math.floor(Math.random() * quotes.length);
    p1.innerHTML = quotes[q];
},3000);