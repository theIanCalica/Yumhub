$(document).ready(function () {
    $.ajax({
        type: "GET",
        url: "/api/articles",
        contentType: false,
        processData: false,
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        dataType: "json",
        success: function (data) {
            const articlesContainer = $("#articles-container");
            articlesContainer.empty();

            data.forEach((article) => {
                const publishedDate = new Date(article.created_at);
                const options = {
                    year: "numeric",
                    month: "long",
                    day: "numeric",
                };
                const formattedDate = publishedDate.toLocaleDateString(
                    "en-US",
                    options
                );
                const articleHtml = `
                <div class="flex items-center bg-white border border-gray-200 rounded-lg shadow-md overflow-hidden mb-6">
                    <div class="w-48 h-48 flex-shrink-0">
                        <img class="w-full h-full object-cover" src="${article.filePath}" alt="Article Image">
                    </div>
                    <div class="p-6 flex flex-col">
                        <span class="text-gray-500 text-sm mb-1">Published on: ${formattedDate}</span>
                        <h2 class="text-2xl font-bold text-gray-900 mb-2">${article.title}</h2>
                        <p class="text-gray-700 text-base">
                            ${article.description}
                        </p>
                    </div>
                </div>
            `;
                articlesContainer.append(articleHtml);
            });
        },
        error: function (data) {
            console.log(data);
        },
    });
});
