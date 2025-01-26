export default {
    tabWidth: 2,
    semicolon: true,
    doubleQuote: true,
    overrides: [
        {
            files: ["*.ts", "*.tsx"],
            options: {
                parser: "typescript",
            },
        },
    ],
};