import { useForm } from "react-hook-form";

type TicketData = {
  firstname: string;
  lastname: string;
  email: string;
  description: string;
  file: string;
};

function SubmitTicket() {
  const {
    register,
    handleSubmit,
    watch,
    formState: { errors },
  } = useForm<TicketData>();
  const onSubmit = handleSubmit((data) => console.log(data));

  return (
    <section className="section">
      <div className="form__container">
        <h1>Submit a ticket</h1>
        <form onSubmit={onSubmit} id="support-submit-ticket" className="form">
          <label
            htmlFor="support-submit-ticket-firstname"
            className="field__label"
          >
            Firstname
          </label>
          <input
            {...register("firstname")}
            type="text"
            id="support-submit-ticket-firstname"
            className="field --text"
            placeholder="Jack"
          />
          <label
            htmlFor="support-submit-ticket-lastname"
            className="field__label"
          >
            Lastname
          </label>
          <input
            {...register("lastname")}
            type="text"
            id="support-submit-ticket-lastname"
            className="field --text"
            placeholder="Holster"
          />
          <label htmlFor="support-submit-ticket-email" className="field__label">
            Email
          </label>
          <input
            {...register("email")}
            type="text"
            id="support-submit-ticket-email"
            className="field --text"
            placeholder="jack.holster@provider.com"
          />
          <label
            htmlFor="support-submit-ticket-description"
            className="field__label"
          >
            Please describe your issue
          </label>
          <textarea
            {...register("description")}
            id="support-submit-ticket-description"
            className="field --textarea"
            placeholder="I cannot do some action in your app. I will describe it here..."
          ></textarea>
          <label htmlFor="support-submit-ticket-file" className="field__label">
            Attach a screenshot
          </label>
          <input
            {...register("file")}
            id="support-submit-ticket-file"
            type="file"
            className="field --file"
          />
          <input type="submit" className="form__submit" />
        </form>
      </div>
    </section>
  );
}

export default SubmitTicket;
