<style>
    .green-button {
        background-color: #4CAF50;
        color: white;
        padding: 3px 13px;
        border: none;
        border-radius: 5px;
        font-size: 18px;
        box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .green-button:hover {
        background-color: #45A049;
        /* Slightly different shade on hover */
    }

</style>
<button {{ $attributes->merge(['class' => 'green-button']) }}>
    {{ $slot }}
</button>
