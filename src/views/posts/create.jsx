//import useState
import { useState } from "react";

//import useNavigate
import { useNavigate } from "react-router-dom";

//import API
import api from "../../api";

export default function PostCreate() {
    // Mendefinisikan state
    const [image, setImage] = useState("");
    const [title, setTitle] = useState("");
    const [content, setContent] = useState("");

    // State untuk validasi
    const [errors, setErrors] = useState([]);

    // React Navigate
    const navigate = useNavigate();

    // Metode untuk menangani perubahan file
    const handleFileChange = (e) => {
        setImage(e.target.files[0]);
    };

    // Method untuk menyimpan post
    const storePost = async (e) => {
        e.preventDefault();

        // Inisialisasi FormData
        const formData = new FormData();

        // Menambahkan data
        formData.append("image", image);
        formData.append("title", title);
        formData.append("content", content);

        // Mengirim data dengan Axios
        await api
            .post("/api/posts", formData)
            .then(() => {
                // Redirect ke halaman posts
                navigate("/posts");
            })
            .catch((error) => {
                // Set state "errors" dengan response API
                setErrors(error.response.data);
            });
    };

    return (
        <div className="container mt-5">
            <div className="row">
                <div className="col-md-12">
                    <div className="card border-0 rounded shadow">
                        <div className="card-body">
                            <form onSubmit={storePost}>
                                <div className="mb-3">
                                    <label className="form-label fw-bold">
                                        Image
                                    </label>
                                    <input
                                        type="file"
                                        onChange={handleFileChange}
                                        className="form-control"
                                    />
                                    {errors.image && (
                                        <div className="alert alert-danger mt-2">
                                            {errors.image[0]}
                                        </div>
                                    )}
                                </div>

                                <div className="mb-3">
                                    <label className="form-label fw-bold">
                                        Title
                                    </label>
                                    <input
                                        type="text"
                                        className="form-control"
                                        onChange={(e) =>
                                            setTitle(e.target.value)
                                        }
                                        placeholder="Title Post"
                                    />
                                    {errors.title && (
                                        <div className="alert alert-danger mt-2">
                                            {errors.title[0]}
                                        </div>
                                    )}
                                </div>

                                <div className="mb-3">
                                    <label className="form-label fw-bold">
                                        Content
                                    </label>
                                    <textarea
                                        className="form-control"
                                        onChange={(e) =>
                                            setContent(e.target.value)
                                        }
                                        rows="5"
                                        placeholder="Content Post"
                                    ></textarea>
                                    {errors.content && (
                                        <div className="alert alert-danger mt-2">
                                            {errors.content[0]}
                                        </div>
                                    )}
                                </div>

                                <button
                                    type="submit"
                                    className="btn btn-md btn-primary rounded-sm shadow border-0"
                                >
                                    Simpan
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
}
