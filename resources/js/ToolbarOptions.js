export const toolbarOptions = [
    ["blockquote", "code-block"],
    ["link", "image", "video", "formula"],
    ["bold", "italic", "underline", "strike"], // toggled buttons

    [{ list: "ordered" }, { list: "bullet" }, { list: "check" }],
    [{ script: "sub" }, { script: "super" }], // superscript/subscript
    [{ indent: "-1" }, { indent: "+1" }], // outdent/indent
    [{ direction: "rtl" }], // text direction

    [{ header: [1, 2, 3, 4, 5, 6, false] }],

    [{ font: [] }],
    [{ color: [] }, { background: [] }], // dropdown with defaults from theme

    [{ align: [] }],
    ["clean"], // remove formatting button
];