const quotes_ar = [];
quotes_ar[0] = "كل ملف هو بداية جديدة.🤍";
quotes_ar[1] = "رفع واحد يمكن أن يشعل ثورة.";
quotes_ar[2] = "أشياء عظيمة تبدأ غالبًا بملف واحد.";
quotes_ar[3] = "فصلك الجديد على بُعد ملف واحد فقط.✨";
quotes_ar[4] = "الأفكار تعيش في كل بايت مرفوع.";
quotes_ar[5] = "ملف بسيط قد يشعل تغييرًا كبيرًا.";
quotes_ar[6] = "خلف كل ملف، هناك قصة.🖤";
quotes_ar[7] = "ارفع. شارك. ألهم.";
quotes_ar[8] = "ملفات صغيرة، تأثير كبير.💞";
quotes_ar[9] = "دع ملفاتك تتحدث.";
quotes_ar[10] = "أنشئ. ارفع. وابدأ من جديد.💦";
quotes_ar[11] = "ملف جديد، فرصة جديدة.";
quotes_ar[12] = "ابدأ صغيرًا، وفكر كبيرًا.💜";
quotes_ar[13] = "من البايتات إلى الإبداع.";
quotes_ar[14] = "كل رفع هو خطوة إلى الأمام.🤎";

const quote = Math.floor(Math.random() * quotes_ar.length)
const p_ar = document.getElementById('p-arFot');
const p1 = document.getElementById('quote');

p_ar.innerHTML = quotes_ar[quote];
setInterval(() => {
    const q = Math.floor(Math.random() * quotes_ar.length);
    p1.innerHTML = quotes_ar[q];
},3000);