// Komponen TodoItem
const TodoItem = ({ todo, setRefresh }) => {
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

    // Fungsi untuk menghapus todo
    const deleteTodo = () => {
        fetch("http://localhost:8000/todos/" + todo.id, {
            method: "DELETE",
        }).then(() => {
            console.log("todo deleted.");
            setRefresh(true);
        });
    };

    return (
        // Menampilkan todo dari props yang dikirim oleh komponen TodoList
        <li className={`${todo.done ? "checked" : ""}`}>
            <div onClick={updateTodo}>{todo.title}</div>
            <span className="close" onClick={deleteTodo}>
                x
            </span>
        </li>
    );
};

export default TodoItem;
