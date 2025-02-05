// Komponen TodoItem
const TodoItem = ({ todo }) => {
    // Fungsi untuk mengubah status todo
    const updateTodo = () => {
        todo.done = !todo.done;

        fetch("http://localhost:8000/todos/" + todo.id, {
            method: "PUT",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify(todo),
        }).then(() => {
            console.log("todo updated.");
            setRefresh(true);
        });
    };

    return (
        // Menampilkan todo dari props yang dikirim oleh komponen TodoList
        <li className={`${todo.done ? "checked" : ""}`}>
            {todo.title} <span className="close">x</span>
        </li>
    );
};

export default TodoItem;
