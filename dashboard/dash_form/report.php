 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="form.css">
    <title>Document</title>
 </head>
 <body>
 <div class="form-container">
                <h2>Report Form</h2>
                <form id="reportForm">
                    <label for="reportId">Report ID:</label>
                    <input type="text" id="reportId" name="reportId" required>
        
                    <label for="reportDate">Date:</label>
                    <input type="date" id="reportDate" name="reportDate" required>
        
                    <label for="reportDetails">Details:</label>
                    <textarea id="reportDetails" name="reportDetails" required></textarea>
        
                    <button type="submit">Submit</button>
                </form>
            </div>
 </body>
 </html>