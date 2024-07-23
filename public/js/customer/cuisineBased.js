$(document).ready(function () {
    const search = instantsearch({
        indexName: "foods",
        searchClient: algoliasearch(
            "2ZSR07S44R",
            "f6883efda15a6fa9e04586d44cbfcd5e"
        ),
    });

    // Add search box
    search.addWidget(
        instantsearch.widgets.searchBox({
            container: "#search-bar",
            placeholder: "Search for foods...",
        })
    );

    // Add hits display
    search.addWidget(
        instantsearch.widgets.hits({
            container: "#foods-container",
            templates: {
                item: `
    <div class="bg-white border border-gray-200 rounded-lg shadow-lg transition-transform transform hover:scale-105 hover:shadow-xl">
        <img src="{{  filePath }}" alt="{{ name }}" class="w-full h-48 object-cover rounded-t-lg">
        <div class="p-6">
            <h2 class="text-2xl font-bold text-red-800 mb-2 merriweather-bold">{{ attributes . name }}</h2>
            <p class="text-gray-600 mb-2 text-sm">{{  category }}</p>
            <p class="text-2xl font-bold text-red-600 mb-4">₱{{  price }}</p>
            <button data-id="{{ objectID }}" data-name="{{   name }}"
                data-category="{{   category }}" data-price="{{  price }}"
                class="add-to-cart bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition-colors">
                Add to Cart
            </button>
        </div>
    </div>
    `,
            },
        })
    );

    // Start the search instance
    search.start();
});
