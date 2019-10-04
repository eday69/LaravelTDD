module.exports = {
    theme: {
        backgroundColor: theme => ({
            page: 'var(--page-background-color)',
            card: 'var(--card-background-color)',
            button: 'var(--button-background-color)',
            header: 'var(--header-background-color)',
        }),

        extend: {
            colors: theme => ({
                default: 'var(--text-default-color)',
            }),
        },
    },
    variants: {
    },
    plugins: [
    ]
}

