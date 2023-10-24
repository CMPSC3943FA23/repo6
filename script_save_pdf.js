function savePDF(filename) {
    console.log("Filename: " + filename)
    let contentToSave = document.querySelector(".pdf-target");

    let opt = {
        margin:       10,
        filename:     filename,
        image:        { type: 'jpeg', quality: 0.98 },
        html2canvas:  { scale: 2 },
        jsPDF:        { unit: 'mm', format: 'a4', orientation: 'landscape' }
    };

    html2pdf().from(contentToSave).set(opt).save();
};