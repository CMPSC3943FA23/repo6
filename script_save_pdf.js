function savePDF(filename, query) {
    let contentToSave = document.querySelector(query);

    let opt = {
        margin:       10,
        filename:     filename,
        image:        { type: 'jpeg', quality: 0.98 },
        html2canvas:  { scale: 2 },
        jsPDF:        { unit: 'in', format: 'letter', orientation: 'landscape' }
    };

    html2pdf().from(contentToSave).set(opt).save();
};